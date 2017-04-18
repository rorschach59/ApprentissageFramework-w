<?php

namespace Model;

class ArticleCategoryModel extends \W\Model\Model
{
  /**
    * On supprime toutes les catégories d'un article
   */
   public function deleteByArticle($id)
   {
		if (!is_numeric($id)){
			return false;
		}

		$sql = 'DELETE FROM ' . $this->table . ' WHERE id_article = :id';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		return $sth->execute();
   }
}

?>
