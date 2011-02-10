PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;

CREATE TABLE  t_calendar_user (
  id INTEGER PRIMARY KEY,
  cal_id INTEGER,
  name varchar
);

CREATE TABLE  t_calendar (
  id INTEGER PRIMARY KEY,
  cal_type varchar,
  create_time time,
  name varchar,
  description TEXT
);
CREATE TABLE t_record (
  id INTEGER PRIMARY KEY,
  rec_date DATE,
  name varchar,
  cal_id INTEGER,
  startTime time,
  endTime time,
  description TEXT
);
CREATE TABLE t_record_user (
  name varchar PRIMARY KEY,
  pass varchar,
  description TEXT
);
INSERT INTO t_record_user VALUES('admin','1234','代码工人');
INSERT INTO t_calendar(cal_type,create_time,name,description) VALUES('_default',date('now'),'admin_default','默认');
INSERT INTO t_calendar_user(cal_id,name) VALUES(1,'admin');
COMMIT;
