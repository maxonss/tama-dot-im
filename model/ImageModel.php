<?php
/**
 * Model used for every images stored into database
 */
class ImageModel
{
    /**
     * Insert a new Image object in database
     * @param object $img the image 
     */
    public static function add(Image $img)
    {
        $db = Connect::getDb();
        $q = $db->prepare("INSERT INTO images (file_name,extension_id,alt_text,full_path_to_image) VALUES (:file_name,:extension_id,:alt_text,:full_path_to_image)");
        $q->bindValue(":file_name", $img->getFileName());
        $q->bindValue(":extension_id", $img->getExtensionId());
        $q->bindValue(":alt_text", $img->getAltText());
        $q->bindValue(":full_path_to_image", $img->getFullPathToImage());
        $q->execute();
    }

    /**
     * Update the image given in parameter
     * @param object $img the image updated in database
     */
    public static function update(Image $img)
    {
        $db = Connect::getDb();
        $q = $db->prepare("UPDATE images SET file_name=:file_name, extension_id=:extension_id, alt_text=:alt_text, full_path_to_image=:full_path_to_image WHERE id=:id");
        $q->bindValue(":file_name", $img->getFileName());
        $q->bindValue(":extension_id", $img->getExtensionId());
        $q->bindValue(":alt_text", $img->getAltText());
        $q->bindValue(":full_path_to_image", $img->getFullPathToImage());
        $q->bindValue(":id", $img->getId());
        $q->execute();
    }

    /**
     * Delete the given image in database
     * @param object $img the image that'll be deleted
     */
    public static function delete(Image $img)
    {
        $db = Connect::getDb();
        $db->exec("DELETE FROM images WHERE id=" . $img->getId());
    }

    /**
     *  Returns an Image object from database using its identifier
     *  @param int $id the Image identifier
     * @return object — `new Image($res)` — return `false` if the user does not exist
     */
    public static function findById($id)
    {
        $db = Connect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM images WHERE id=" . $id);
        $res = $q->fetch(PDO::FETCH_ASSOC);
        if ($res != false) {
            return new Image($res);
        } else {
            return false;
        }
    }

    /**
     * Returns the list of all user's types
     * @return array[object] $res the list of every image in database
     */
    public static function getList()
    {
        $db = Connect::getDb();
        $res = [];
        $q = $db->query("SELECT * FROM images");
        while ($datas = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($datas != false) {
                $res[] = new Image($datas);
            }
        }
        return $res;
    }
}
