<?php
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('CREATE TABLE IF NOT EXISTS login (
        user_id INTEGER PRIMARY KEY,
        username varchar(50),
        email varchar(50),
        passwd varchar(100),
        identifier TEXT,
        fk_group INTEGER,
        FOREIGN KEY (fk_group)
            REFERENCES "group" (group_id))');