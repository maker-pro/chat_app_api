<?php
/**
 * BookCategory.php
 * User: Joe
 * Date: 2023/3/22
 * Time: 14:58
 */

namespace model\book;

use \model\BaseModel;

class BookCategoryModel extends BaseModel {
    protected $table = 'book_category';

    public function getAllCategory() {
        $self = new self();
        return $self->where('id', '>', '0')->getRows('*');
    }
}