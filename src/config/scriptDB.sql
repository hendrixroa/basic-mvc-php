DROP DATABASE test;
CREATE DATABASE test;
\connect test;

CREATE TABLE items (
    code int,
    txt char(10)    
);

INSERT INTO items VALUES (123, 'item1');
INSERT INTO items VALUES (345, 'item2');
INSERT INTO items VALUES (678, 'item3');