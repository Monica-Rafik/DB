<?php

class Database {
    private $id;
    private $name;
    private $password;
    private $email;
    private $connection;

    public function connect($id, $name, $password, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;

        $this->connection = new mysqli($this->id, $this->name, $this->password, $this->email);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function insert($table, $columns, $values) {
        $columns = implode(", ", $columns);
        $values = "'" . implode("', '", $values) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        if ($this->connection->query($sql) === TRUE) {
            echo "Record inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $this->connection->error;
        }
    }

    public function select($table) {
        $sql = "SELECT * FROM $table";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                print_r($row);
            }
        } else {
            echo "No records found.";
        }
    }

    public function update($table, $id, $fields) {
        $updates = [];
        foreach ($fields as $column => $value) {
            $updates[] = "$column = '$value'";
        }
        $updates = implode(", ", $updates);
        $sql = "UPDATE $table SET $updates WHERE id = $id";

        if ($this->connection->query($sql) === TRUE) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . $this->connection->error;
        }
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = $id";

        if ($this->connection->query($sql) === TRUE) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record: " . $this->connection->error;
        }
    }

    public function close() {
        $this->connection->close();
    }
}

$db = new Database();
$db->connect("id", "name", "password", "email");

$db->insert("users", ["name", "email"], ["Monica Rafik ", "monica@gmail.com"]);

$db->select("users");

$db->update("users", 1, ["name" => "Marian Rafik", "email" => "marian@gmail.com"]);

$db->delete("users", 1);

$db->close();
?>
