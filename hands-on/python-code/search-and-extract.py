#author: myapit
#purpose: search recursive one folder and read one file and extract url from that file

import os
import re
import sys

# define function


def extract_github_url(config_file_path):
    with open(config_file_path, 'r') as file:
        content = file.read()
        # Extracting the URL from the git config file
        url_match = re.search(r'url = (https?://[^\s]*)', content)
        if url_match:
            return url_match.group(1)

def list_folders_and_extract_github_urls(root_folder):
    for foldername, subfolders, filenames in os.walk(root_folder):
        if '.git' in subfolders:
            git_config_path = os.path.join(foldername, '.git', 'config')
            if os.path.exists(git_config_path):
                github_url = extract_github_url(git_config_path)
                if github_url:
                    print(f"{foldername} : {github_url}")

# usage:
arg_len = len(sys.argv)
if arg_len == 1:
    print(f"Usage : {sys.argv[0]} <folder_path>")
    exit()
else:
    root_directory = sys.argv[1]
    list_folders_and_extract_github_urls(root_directory)
