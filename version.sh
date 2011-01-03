#!/bin/sh
TMP_SED='version1.sed'
SVN_VERSION=$(svn info | grep Revision | awk -F '[: ]' '{print $3}')
cat <<EOT >$TMP_SED
s|url(\\(['"]\{0,1\}\\)\([^'")]*\\)\1)|url('\2?v=$SVN_VERSION')|g
EOT
for file in $(find ./release/my.soso.com/webroot/ -name *.css);do
    sed -i -f $TMP_SED $file
done
rm $TMP_SED
