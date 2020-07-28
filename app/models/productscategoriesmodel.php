<?php

namespace Store\Models;

use Store\Core\DB;
use Store\core\Input;

class ProductsCategoriesModel extends AbsModel
{

    public $ProductCategoryId, $ProductCategoryParentId, $Name , $Description;
    const TABLE = 'app_products_categories';
    const ForeignKey = 'ProductCategoryId';



    public function __construct()
    {
        $this->Table = SELF::TABLE;
        $this->ForeignKey = SELF::ForeignKey;
    }

    public function create()
    {
        $insetValues = [$this->ProductCategoryParentId, $this->Name, $this->Description];
        return DB::insert('insert into '. self::TABLE .' (`ProductCategoryParentId`, `Name`,Description) values (?,?,?)',$insetValues);
    }

    public function update()
    {
        $updateValues = [$this->ProductCategoryParentId, $this->Name, $this->Description, $this->ProductCategoryId];
        return DB::update("update ". self::TABLE ." set ProductCategoryParentId=?, Name=? , Description=? WHERE ProductCategoryId=?",$updateValues);
    }

    public function delete()
    {
        return DB::table(self::TABLE)->where(self::ForeignKey,'=',$this->ProductCategoryId)->delete();
    }

	public static function getColByKey($col,$id)
    {
        if(is_numeric($id)){
            if(DB::table(self::TABLE)->select($col)->where(self::ForeignKey,'=',$id)->getColumn() != '' )
            {
                return DB::table(self::TABLE)->select($col)->where(self::ForeignKey,'=',$id)->getColumn()->{$col};
            }
        }
        return false;

    }

}