PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;

CREATE TABLE post(
  post_id INTEGER PRIMARY KEY,
  date_created DATE,
  title varchar,
  contents varchar,
  rating INTEGER
);
COMMIT;
