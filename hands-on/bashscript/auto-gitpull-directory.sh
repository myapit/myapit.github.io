
#!/bin/bash

if [ -z "$1" ]
   then
	echo "Usage : $0 <full-path-direcory>"
	exit 1
else
    echo "Checking ..."
fi
root_directory=$1
echo -p "dir:$root_directory"

for foldername in "$root_directory"/*; do
    if [ -d "$foldername" ]; then
        (cd "$foldername" && git pull --all)
        if [ $? -eq 0 ]; then
            echo "Git pull executed successfully in $(basename "$foldername")."
        else
            echo "Error executing git pull in $(basename "$foldername")."
        fi
    fi
done
