<?php
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('CREATE TABLE IF NOT EXISTS class (
        class_id INTEGER PRIMARY KEY,
        class varchar(50) NOT NULL,
        fk_user INTEGER,
        FOREIGN KEY (fk_user)
            REFERENCES login (user_id))');