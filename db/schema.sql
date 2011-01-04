PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE record (
  id INTEGER PRIMARY KEY,
  rec_date DATE,
  name varchar,
  startTime time,
  endTime time,
  description TEXT
);
CREATE TABLE record_user (
  name varchar PRIMARY KEY,
  pass varchar,
  description TEXT
);
INSERT INTO "record_user" VALUES('admin','1234','代码工人');
COMMIT;
