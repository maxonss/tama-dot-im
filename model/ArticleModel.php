<?php
/**
 * Model for the article class
 */
class ArticleModel
{
    /**
     * Insert a new aricle in database
     * @param object $art the object that'll be inserted in database
     */
    public static function create(Article $art)
    {
        $db = Connect::getDb();
        $q = $db->prepare("INSERT INTO articles (metadatas_id,slug,title,short_description,preview_image_id,writer_id,date_created,date_published,is_published,updater_id,date_updated) VALUES (:metadatas_id,:slug,:title,:short_description,:preview_image_id,:writer_id,:date_created,:date_published,:is_published,:updater_id,:date_updated)");
        $q->bindValue(":metadatas_id", $art->getMetadatasId());
        $q->bindValue(":slug", $art->getSlug());
        $q->bindValue(":title", $art->getTitle());
        $q->bindValue(":short_description", $art->getShortDescription());
        $q->bindValue(":preview_image_id", $art->getPreviewImageId());
        $q->bindValue(":writer_id", $art->getWriterId());
        $q->bindValue(":date_created", $art->getDateCreated());
        $q->bindValue(":date_published", $art->getDatePublished());
        $q->bindValue(":is_published", $art->getIsPublished());
        $q->bindValue(":updater_id", $art->getUpdaterId());
        $q->bindValue(":date_updated", $art->getDateUpdated());
        $q->execute();
    }

    public static function update(Article $art)
    {
        $db = Connect::getDb();
        $q = $db->prepare("UPDATE articles SET metadatas_id=:metadatas_id, slug=:slug, title=:title, short_description=:short_description, preview_image_id=:preview_image_id, writer_id=:writer_id, date_created=:date_created, date_published=:date_published, is_published=:is_published, updater_id=:updater_id, date_updated=:date_updated WHERE id=:id");
        $q->bindValue(":metadatas_id", $art->getMetadatasId());
        $q->bindValue(":slug", $art->getSlug());
        $q->bindValue(":title", $art->getTitle());
        $q->bindValue(":short_description", $art->getShortDescription());
        $q->bindValue(":preview_image_id", $art->getPreviewImageId());
        $q->bindValue(":writer_id", $art->getWriterId());
        $q->bindValue(":date_created", $art->getDateCreated());
        $q->bindValue(":date_published", $art->getDatePublished());
        $q->bindValue(":is_published", $art->getIsPublished());
        $q->bindValue(":updater_id", $art->getUpdaterId());
        $q->bindValue(":date_updated", $art->getDateUpdated());
        $q->bindValue(":id", $art->getId());
        $q->execute();
    }

    public static function delete(Article $art)
    {
        $db = Connect::getDb();
        $db->exec("DELETE FROM articles WHERE id=" . $art->getId());
    }

    public static function findById($id)
    {
        $db = Connect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM articles WHERE id=" . $id);
        $res = $q->fetch(PDO::FETCH_ASSOC);
        if ($res != false) {
            return new Article($res);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = Connect::getDb();
        $res = [];
        $q = $db->query("SELECT * FROM articles");
        while ($datas = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($datas != false) {
                $res[] = new Article($datas);
            }
        }
        return $res;
    }
}
