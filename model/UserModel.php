<?php
/**
 * Model for the User's class
 */
class UserModel
{
    /**
     * Inserts a new user into the database
     * @param object $usr the User object we want to add
     * @return void `PDO::execute()`
     */
    public static function add(User $usr)
    {
        $db = Connect::getDb();
        $q = $db->prepare("INSERT INTO users (first_name,last_name,username,password,type_id,date_of_birth) VALUES (:first_name,:last_name,:username,:password,:type_id,:date_of_birth)");
        $q->bindValue(":first_name", $usr->getFirstName());
        $q->bindValue(":last_name", $usr->getLastName());
        $q->bindValue(":username", $usr->getUsername());
        $q->bindValue(":password", $usr->getPassword());
        $q->bindValue(":type_id", $usr->getTypeId());
        $q->bindValue(":date_of_birth", $usr->getDateOfBirth());
        $q->execute();

    }

    /**
     * Update the given User object in database
     * 
     * Database's row is found thanks to the `user.id` column
     * @param object $usr the User object we want to update
     * @return void `PDO::execute()`
     */
    public static function update(User $usr)
    {
        $db = Connect::getDb();
        $q = $db->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name, username=:username, password=:password, type_id=:type_id, date_of_birth=:date_of_birth, registration_date=:registration_date, is_logged_in=:is_logged_in, 2fa_token=:2fa_token WHERE id=:id");
        $q->bindValue(":first_name", $usr->getFirstName());
        $q->bindValue(":last_name", $usr->getLastName());
        $q->bindValue(":username", $usr->getUsername());
        $q->bindValue(":password", $usr->getPassword());
        $q->bindValue(":type_id", $usr->getTypeId());
        $q->bindValue(":date_of_birth", $usr->getDateOfBirth());
        $q->bindValue(":registration_date", $usr->getRegistrationDate());
        $q->bindValue(":is_logged_in", $usr->getIsLoggedIn());
        $q->bindValue(":2fa_token", $usr->get2faToken());
        $q->bindValue(":id", $usr->getId());
        $q->execute();
    }

    /**
     * Detele the given User object from the database
     * @param object $usr the User we want to delete
     * @return void `PDO::execute()`
     */
    public static function delete(User $usr)
    {
        $db = Connect::getDb();
        $db->exec("DELETE FROM users WHERE id=" . $usr->getId());
    }

    /**
     * Fetch all the attributes of a registration of the database
     * using its identifier
     * @param int $id identifier of the user we want to find
     * @return object `new User[$res]` — return `false` if the user does not exist
     */
    public static function findById($id)
    {
        $db = Connect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM users WHERE id=" . $id);
        $res = $q->fetch(PDO::FETCH_ASSOC);
        if ($res != false) {
            return new User($res);
        } else {
            return false;
        }
    }

    /**
     * Fetch the list of every users registration in database
     * @return array[object]|false $res the list of every users as an array of User objects or false when there are none
     */
    public static function getList()
    {
        $db = Connect::getDb();
        $res = [];
        $q = $db->query("SELECT * FROM users");
        while ($datas = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($datas != false) {
                $res[] = new User($datas);
            }
        }
        return $res;
    }
}
