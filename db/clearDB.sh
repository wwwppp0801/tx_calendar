#!/bin/sh
rm -f calendar.db
sqlite3 calendar.db '.read schema.sql';
chmod 666 calendar.db
