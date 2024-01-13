#author :myapit
#purpose: run git pull inside each directory

import os
import subprocess
import sys

#user defined function
def git_pull_all_in_directories(root_folder):
    for foldername in os.listdir(root_folder):
        full_path = os.path.join(root_folder, foldername)
        if os.path.isdir(full_path):
            try:
                subprocess.run(['git', 'pull', '--all'], check=True)
                print(f"Git pull executed successfully in {foldername}.")
            except subprocess.CalledProcessError as e:
                print(f"Error executing git pull in {foldername}: {e}")

# usage:
arg_len = len(sys.argv)
if arg_len == 1:
    print(f"Usage : {sys.argv[0]} <folder_path>")
    exit()
else:
    root_directory = sys.argv[1]
    git_pull_all_in_directories(root_directory)

