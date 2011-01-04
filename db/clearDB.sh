#!/bin/sh
rm -f room.db
sqlite3 room.db '.read schema.sql';
chmod 666 room.db
