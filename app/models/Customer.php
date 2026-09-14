<?php
use Medoo\Medoo;

class Customer extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll($where_condition = [], $offset = '', $limit = '')
    {
        return $this->getConnection()->select('customer', '*', [
            ...$where_condition,
            'ORDER' => ['id' => 'DESC'],
            'LIMIT' => [$offset, $limit],
        ]);
    }

    public function find($id)
    {
        return $this->getConnection()->get('customer', '*', ['id' => $id]);
    }

    public function create($data)
    {
        return $this->getConnection()->insert('customer', [
            'customer_code' => $data['customer_code'],
            'name'          => $data['name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'address'       => $data['address'],
            'company_id'    => $data['company_id'],
        ]);
    }

    public function update($data, $condition)
    {
        return $this->getConnection()->update('customer', [
            'name'    => $data['name'],
            'email'   => $data['email'],
            'phone'   => $data['phone'],
            'address' => $data['address'],
        ], $condition);
    }

    public function delete($id)
    {
        return $this->getConnection()->delete('customer', ['id' => $id]);
    }

    public function getTotalCount($where_condition = [])
    {
        return $this->getConnection()->count('customer', $where_condition);
    }

    public function getBestCustomer()
    {
        return $this->getConnection()->get('customer', [
            '[><]invoice' => ['id' => 'customer_id'],
            '[><]invoice_detail' => ['invoice.id' => 'invoice_id']
        ], [
            'customer.name',
            'total_spent' => Medoo::raw('SUM(<invoice_detail.amount>)')
        ], [
            'customer.company_id' => $this->companyId,
            'GROUP' => 'customer.id',
            'ORDER' => ['total_spent' => 'DESC'],
            'LIMIT' => 1
        ]);
    }

    public function isCodeTakenByOther($customerCode, $checkCondition)
    {
        $owner_id = $this->getConnection()->get('customer', 'id', ['customer_code' => $customerCode]);

        if ($owner_id === null) {
            return false;
        }

        $current_id = $this->getConnection()->get('customer', 'id', $checkCondition);

        return $owner_id != $current_id;
    }

    public function countTotalCustomer()
    {
        return $this->getConnection()->count('customer', [
            'company_id' => $this->companyId
        ]) ?: 0;
    }
}