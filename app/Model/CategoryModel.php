<?php

namespace Model;

class CategoryModel extends \W\Model\Model
{
  public function countArticleIncategory()
  {
    $query = $this->dbh->query('SELECT name, COUNT(*) as articles FROM category INNER JOIN article_category ON category.id = article_category.id_category GROUP BY category.name');
    return $query->fetchAll();
  }
}

?>
