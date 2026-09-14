<?php

use Medoo\Medoo;

class Invoice extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll($join, $where_condition, $offset = '', $limit = '')
    {
        return $this->getConnection()->select('invoice', $join, [
            'invoice.id',
            'invoice.customer_id',
            'invoice.invoice_code',
            'invoice.date',
            'invoice.due_date',
            'customer.name(customer_name)',
            'total_bill' => Medoo::raw('(SELECT COALESCE(SUM(amount),0) FROM invoice_detail WHERE invoice_detail.invoice_id = <invoice.id>)'),
            'total_payment' => Medoo::raw('(SELECT COALESCE(SUM(amount),0) FROM payment WHERE payment.invoice_id = <invoice.id>)'),
            'total_amount_paid' => Medoo::raw('(SELECT COALESCE(SUM(payment.amount), 0) FROM payment WHERE payment.invoice_id = <invoice.id>)')
        ], [
            ...$where_condition,
            'GROUP' => 'invoice.id',
            'ORDER' => ['invoice.id' => 'DESC'],
            'LIMIT' => [$offset, $limit]
        ]);
    }

    public function getAllCompact()
    {
        return $this->getConnection()->select('invoice', [
            '[><]customer' => ['customer_id' => 'id'],
        ], [
            'invoice.id',
            'invoice.invoice_code',
            'invoice.date',
            'invoice.due_date',
            'customer.name(customer_name)',
            'total_bill' => Medoo::raw('(SELECT COALESCE(SUM(amount),0) FROM invoice_detail WHERE invoice_detail.invoice_id = <invoice.id>)'),
            'total_payment' => Medoo::raw('(SELECT COALESCE(SUM(amount),0) FROM payment WHERE payment.invoice_id = <invoice.id>)')
        ], [
            'GROUP' => 'invoice.id',
            'ORDER' => ['invoice.id' => 'DESC'],
            'invoice.company_id' => $this->companyId,
            'LIMIT' => 6
        ]);
    }

    public function find($id)
    {
        return $this->getConnection()->get('invoice', '*', [
            'id' => $id
        ]);
    }

    public function create($data)
    {
        $this->getConnection()->insert('invoice', [
            'invoice_code' => $data['invoice_code'],
            'date' => $data['date'],
            'due_date' => $data['due_date'],
            'company_id' => $data['company_id'],
            'customer_id' => $data['customer_id'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function update($id, $data)
    {
        $this->getConnection()->update('invoice', [
            'customer_id' => $data['customer_id'],
            'date' => $data['date'],
            'due_date' => $data['due_date']
        ], [
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        return $this->getConnection()->delete('invoice', [
            'id' => $id
        ]);
    }

    public function countInvoiceStatus($where_condition = [])
    {
        $today = date('Y-m-d');

        $invoices = $this->getConnection()->select('invoice', [
            'id',
            'due_date',
            'total_bill' => Medoo::raw('(SELECT COALESCE(SUM(amount),0) FROM invoice_detail WHERE invoice_detail.invoice_id = <invoice.id>)'),
            'total_payment' => Medoo::raw('(SELECT COALESCE(SUM(amount),0) FROM payment WHERE payment.invoice_id = <invoice.id>)')
        ], [
            ...$where_condition
        ]);

        $total_invoice = count($invoices);
        $total_paid = 0;
        $total_unpaid = 0;
        $total_overdue = 0;

        foreach ($invoices as $invoice) {
            $remaining_unpaid = $invoice['total_bill'] - $invoice['total_payment'];

            if ($remaining_unpaid > 0 && $invoice['due_date'] < $today) {
                $total_overdue++;
            } elseif ($invoice['total_payment'] == $invoice['total_bill']) {
                $total_paid++;
            } elseif ($invoice['total_payment'] < $invoice['total_bill']) {
                $total_unpaid++;
            }
        }

        return compact('total_invoice', 'total_paid', 'total_unpaid', 'total_overdue');
    }

    public function sumInvoiceValue()
    {
        return $this->getConnection()->sum('invoice', [
            '[><]invoice_detail' => ['id' => 'invoice_id']
        ], 'invoice_detail.amount', [
            'company_id' => $this->companyId
        ]) ?: 0;
    }

    public function sumOverdue($today)
    {
        $total_overdue = 0;

        $invoices = $this->getConnection()->select('invoice', [
            'id',
            'due_date',
            'total_bill' => Medoo::raw('(SELECT COALESCE(SUM(amount),0) FROM invoice_detail WHERE invoice_detail.invoice_id = <invoice.id>)'),
            'total_payment' => Medoo::raw('(SELECT COALESCE(SUM(amount),0) FROM payment WHERE payment.invoice_id = <invoice.id>)')
        ], [
            'invoice.company_id' => $this->companyId,
        ]);

        foreach ($invoices as $invoice) {
            $remaining = $invoice['total_bill'] - $invoice['total_payment'];

            if ($remaining > 0) {
                if ($invoice['due_date'] < $today) {
                    $total_overdue += $remaining;
                }
            }
        }

        return compact('total_overdue');
    }

    public function sumUnpaid($today)
    {
        $total_unpaid = 0;

        $invoices = $this->getConnection()->select('invoice', [
            'id',
            'due_date',
            'total_bill' => Medoo::raw('(SELECT COALESCE(SUM(amount),0) FROM invoice_detail WHERE invoice_detail.invoice_id = <invoice.id>)'),
            'total_payment' => Medoo::raw('(SELECT COALESCE(SUM(amount),0) FROM payment WHERE payment.invoice_id = <invoice.id>)')
        ], [
            'invoice.company_id' => $this->companyId,
        ]);

        foreach ($invoices as $invoice) {
            $remaining = $invoice['total_bill'] - $invoice['total_payment'];

            if ($remaining > 0 && $invoice['due_date'] >= $today) {
                $total_unpaid += $remaining;
            }
        }

        return compact('total_unpaid');
    }

    public function validatorPeriod($period)
    {
        if ($period === 'daily') {
            $periodKeyExpr   = "DATE(<invoice.date>)";
            $periodLabelExpr = "DATE_FORMAT(<invoice.date>, '%W, %d %M %Y')";
            $limit           = 7;
        } elseif ($period === 'weekly') {
            $periodKeyExpr   = "YEARWEEK(<invoice.date>, 1)";
            $periodLabelExpr = "CONCAT('Week ', WEEK(MIN(<invoice.date>), 1), ' (', DATE_FORMAT(MIN(<invoice.date>), '%M'), ')')";
            $limit           = 5;
        } else {
            $periodKeyExpr   = "DATE_FORMAT(<invoice.date>, '%Y-%m')";
            $periodLabelExpr = "DATE_FORMAT(<invoice.date>, '%Y-%m')";
            $limit           = 6;
        }

        return [
            'periodKeyExpr' => $periodKeyExpr,
            'periodLabelExpr' => $periodLabelExpr,
            'limit' => $limit,
        ];
    }

    public function sumUnpaidPeriod($periodKeyExpr, $periodLabelExpr, $company_id, $limit)
    {
        return $this->getConnection()->select('invoice', [
            'period_key' => Medoo::raw($periodKeyExpr),
            'period' => Medoo::raw($periodLabelExpr),
            'unpaid' => Medoo::raw('SUM((SELECT COALESCE(SUM(amount),0) FROM invoice_detail WHERE invoice_detail.invoice_id = <invoice.id>) - (SELECT COALESCE(SUM(amount),0) FROM payment WHERE payment.invoice_id = <invoice.id>))')
        ], [
            'GROUP' => 'period_key',
            'ORDER' => ['period_key' => 'DESC'],
            'invoice.company_id' => $company_id,
            'LIMIT' => $limit
        ]);
    }
}
