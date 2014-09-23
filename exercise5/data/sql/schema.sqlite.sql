PRAGMA foreign_keys = ON;

CREATE TABLE "user" (
    user_id VARCHAR(36) NOT NULL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(60) NOT NULL,
    name VARCHAR(255)
);

CREATE TABLE "book" (
    book_id VARCHAR(36) NOT NULL PRIMARY KEY,
    title VARCHAR(255),
    author VARCHAR(255),
    isbn VARCHAR(13)
);

CREATE TABLE "user_book" (
    user_id VARCHAR(36) NOT NULL,
    book_id VARCHAR(36) NOT NULL,
    borrowed_on VARCHAR(10) DEFAULT 0 NOT NULL,
    FOREIGN KEY(user_id) REFERENCES user(user_id),
    FOREIGN KEY(book_id) REFERENCES book(book_id),
    PRIMARY KEY (user_id, book_id)
);

CREATE TABLE oauth_clients (
    client_id VARCHAR(80) NOT NULL,
    client_secret VARCHAR(80) NOT NULL,
    redirect_uri VARCHAR(2000) NOT NULL,
    grant_types VARCHAR(80),
    scope VARCHAR(2000),
    user_id VARCHAR(255),
    CONSTRAINT clients_client_id_pk PRIMARY KEY (client_id)
);
CREATE TABLE oauth_access_tokens (
    access_token VARCHAR(40) NOT NULL,
    client_id VARCHAR(80) NOT NULL,
    user_id VARCHAR(255),
    expires TIMESTAMP NOT NULL,
    scope VARCHAR(2000),
    CONSTRAINT access_token_pk PRIMARY KEY (access_token)
);
CREATE TABLE oauth_authorization_codes (
    authorization_code VARCHAR(40) NOT NULL,
    client_id VARCHAR(80) NOT NULL,
    user_id VARCHAR(255),
    redirect_uri VARCHAR(2000),
    expires TIMESTAMP NOT NULL,
    scope VARCHAR(2000),
    id_token VARCHAR(2000),
    CONSTRAINT auth_code_pk PRIMARY KEY (authorization_code)
);
CREATE TABLE oauth_refresh_tokens (
    refresh_token VARCHAR(40) NOT NULL,
    client_id VARCHAR(80) NOT NULL,
    user_id VARCHAR(255),
    expires TIMESTAMP NOT NULL,
    scope VARCHAR(2000),
    CONSTRAINT refresh_token_pk PRIMARY KEY (refresh_token)
);
CREATE TABLE oauth_scopes (
    type VARCHAR(255) NOT NULL DEFAULT "supported",
    scope VARCHAR(2000),
    client_id VARCHAR (80),
    is_default SMALLINT DEFAULT NULL
);
CREATE TABLE oauth_jwt (
    client_id VARCHAR(80) NOT NULL,
    subject VARCHAR(80),
    public_key VARCHAR(2000),
    CONSTRAINT jwt_client_id_pk PRIMARY KEY (client_id)
);

INSERT INTO oauth_clients (client_id, client_secret, redirect_uri) VALUES ("bookshelfapp", "", "/oauth/receivecode");

