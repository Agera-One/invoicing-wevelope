<?php

class Company extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function find($column, $company_id)
    {
        return $this->getConnection()->get('company', $column, ['id' => $company_id]);
    }

    public function updateInfo($id, $datas)
    {
        $this->getConnection()->update('company', [
            'name'             => $datas['name'],
            'business_entity'  => $datas['business_entity'],
            'sector'           => $datas['sector'],
            'website'          => $datas['website'],
            'description'      => $datas['description'],
            'country'          => $datas['country'],
            'province'         => $datas['province'],
            'city'             => $datas['city'],
            'subdistrict'      => $datas['subdistrict'],
            'address'          => $datas['address']
        ], [
            'id' => $id
        ]);
    }

    public function updateContact($id, $datas)
    {
        $this->getConnection()->update('company', [
            'email' => $datas['email'],
            'phone' => $datas['phone']
        ], [
            'id' => $id
        ]);
    }

    public function uploadLogo($id, $new_logo_name)
    {
        $this->getConnection()->update('company', [
            'logo' => $new_logo_name
        ], [
            'id' => $id
        ]);
    }

    public function uploadSignature($id, $new_signature_name)
    {
        $this->getConnection()->update('company', [
            'signature' => $new_signature_name
        ], [
            'id' => $id
        ]);
    }

    public function id()
    {
        return $this->getConnection()->id();
    }
}
