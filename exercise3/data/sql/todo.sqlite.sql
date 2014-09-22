PRAGMA foreign_keys = ON;

BEGIN TRANSACTION;

CREATE TABLE "user" (
    user_id VARCHAR(36) NOT NULL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(60) NOT NULL,
    name VARCHAR(255)
);

CREATE TABLE "list" (
    list_id VARCHAR(36) NOT NULL PRIMARY KEY,
    title VARCHAR(255)
);

CREATE TABLE "task" (
    task_id VARCHAR(36) NOT NULL PRIMARY KEY,
    list_id VARCHAR(36) NOT NULL,
    name VARCHAR(255),
    completed INT(1),
    FOREIGN KEY(list_id) REFERENCES list(list_id)
);

CREATE TABLE "user_list" (
    user_id VARCHAR(36) NOT NULL,
    list_id VARCHAR(36) NOT NULL,
    is_owner INT(1) DEFAULT 0 NOT NULL,
    can_read INT(1) DEFAULT 0 NOT NULL,
    can_write INT(1) DEFAULT 0 NOT NULL,
    FOREIGN KEY(user_id) REFERENCES user(user_id),
    FOREIGN KEY(list_id) REFERENCES list(list_id),
    PRIMARY KEY (user_id, list_id)
);

COMMIT;
