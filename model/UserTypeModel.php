<?php
/**
 * Model for the tser's types class
 */
class UserTypeModel
{
    /**
     * Insert the given UserType object to the database
     * @param object $ty the type we want to add in database
     */
    public static function add(UserType $ty)
    {
        $db = Connect::getDb();
        $q = $db->prepare("INSERT INTO user_types (name) VALUES (:name)");
        $q->bindValue(":name", $ty->getName());
        $q->execute();
    }
    /**
     * Update the given UserType object in database
     * @param object $ty
     */
    public static function update(UserType $ty)
    {
        $db = Connect::getDb();
        $q = $db->prepare("UPDATE user_types SET name=:name WHERE id=:id");
        $q->bindValue(":name", $ty->getName());
        $q->bindValue(":id", $ty->getId());
        $q->execute();
    }

    /**
     * Delete the given UserType in databse
     * @param object $ty
     */
    public static function delete(UserType $ty)
    {
        $db = Connect::getDb();
        $db->exec("DELETE FROM user_types WHERE id=" . $ty->getId());
    }

    /**
     * Search for the user type in database using its identifier
     * @param int $id the user's type we are looking for
     * @return mixed `new UserType[$res]` — returns `false` if the user's type does not exist
     */
    public static function findById($id)
    {
        $db = Connect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM user_types WHERE id=" . $id);
        $res = $q->fetch(PDO::FETCH_ASSOC);
        if ($res != false) {
            return new UserType($res);
        } else {
            return false;
        }
    }

    /**
     * Returns the list of all user's types
     * @return array[object] $res the list of every user's types in database
     */
    public static function getList()
    {
        $db = Connect::getDb();
        $res = [];
        $q = $db->query("SELECT * FROM user_types");
        while ($datas = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($datas != false) {
                $res[] = new UserType($datas);
            }
        }
        return $res;
    }
}
