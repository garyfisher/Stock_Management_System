<?php

namespace Store\Controllers;


use Store\Core\Messenger;
use Store\Core\Validate;
use Store\Models\ProductswarehousesModel;
use Store\Models\SuppliersModel;

class ProductsWarehousesController extends AbsController
{
    public function defaultAction()
    {
        $this->Language->load('template.main');
        $this->Language->load('ProductsWarehouses.default');
        $ProductsWarehouses = new ProductsWarehousesModel();
        $this->Data['ProductsWarehouses'] = $ProductsWarehouses->getAll();
        $this->View();
    }

    public function createAction()
    {
        $this->Language->load('template.main');
        $this->Language->load('template.messengers');
        $this->Language->load('ProductsWarehouses.create');
        $this->Language->load('ProductsWarehouses.label');
        if($this->has_post('submit')){
            $valid = new Validate($this->Language);
            $valid->data = $_POST;
            $valid->rules = [
                'name'          => 'required|max:40|min:3|type:words|unique:app_products_warehouses',
                'description'   => 'max:5000|type:text',
            ];
            if($valid->check()){ // $valid->check()
                $ProductsWarehouses = new ProductsWarehousesModel();
                $ProductsWarehouses->Name = $this->getPost('name');
                $ProductsWarehouses->Description = $this->getPost('description');
                if($ProductsWarehouses->create()){ /// $usersModel->create()
                    Messenger::getInstance()->create($this->Language->get('success_productsWarehouses_added'),Messenger::APP_TYPE_SUCCESS);
                    $this->clear_request();
                }

            }
        }
        $this->View();
    }

    public function editAction()
    {
        $this->Language->load('template.main');
        $this->Language->load('template.messengers');
        $this->Language->load('ProductsWarehouses.label');
        $this->Language->load('ProductsWarehouses.edit');
        $SuppliersModel = new ProductsWarehousesModel();
        $id = self::getGet('id');


        if(self::has_post('submit') && Validate::valid($id,Validate::REGEX_INT)){
            $valid = new Validate($this->Language);
            $valid->primary = ['ProductWarehouseId'];
            $valid->data = $_POST;
            $valid->rules = [
                'name'          => 'required|max:25|min:3|type:words|same_unq:app_products_warehouses',
                'description'   => 'max:5000|type:text',
            ];
            if($valid->check()){ // $valid->check()
                $SuppliersModel->ProductWarehouseId = $this->getGet('id');
                $SuppliersModel->Name = $this->getPost('name');
                $SuppliersModel->Description = $this->getPost('description');
                if($SuppliersModel->update()){
                    Messenger::getInstance()->create($this->Language->get('success_productsWarehouses_updated'),Messenger::APP_TYPE_SUCCESS);
                    $this->clear_request();
                }
            }
        }


        if(self::has_get('id') && Validate::valid($id,Validate::REGEX_INT)){
            if(Validate::valid_unique($id,'app_products_warehouses','ProductWarehouseId')){
                $this->Data['ProductWarehouse'] = $SuppliersModel->getByKey($id);
            }else{
                Messenger::getInstance()->create($this->Language->get('warning_productWarehouse_not_exist'),Messenger::APP_TYPE_WARNING);
                self::redirect('/ProductsWarehouses/');
            }
        }else{
            self::redirect('/ProductsWarehouses/');
        }


        $this->View();
    }

    public function deleteAction()
    {
        $this->Language->load('template.main');
        $this->Language->load('template.Messengers');
        $id = self::getGet('id');
        if(self::has_get('id') && Validate::valid($id,Validate::REGEX_INT) && Validate::valid_unique($id,'app_products_warehouses','ProductWarehouseId')){
            $ProductWarehousesModel = new ProductsWarehousesModel();
            $ProductWarehousesModel->ProductWarehouseId = $id;
            if($ProductWarehousesModel->delete())
            {
                Messenger::getInstance()->create($this->Language->get('success_productsWarehouses_delete'));
                self::redirect('/ProductsWarehouses/');
            }
        }else{
            Messenger::getInstance()->create($this->Language->get('warning_productWarehouse_not_exist'),Messenger::APP_TYPE_WARNING);
            self::redirect('/ProductsWarehouses/');
        }
    }




    public function existAction()
    {
        if(count($_POST) > 0 & self::has_post(key($_POST)))
        {
            $valueOld = isset($_POST['valueOld']) ? $_POST['valueOld'] : false ;
            echo SuppliersModel::table('app_products_warehouses')->exist(key($_POST),self::getPost(key($_POST)),$valueOld);
        }
    }
}