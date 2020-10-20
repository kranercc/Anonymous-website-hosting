import os
import sys


fileX = sys.argv[1]

extension = fileX.split(".")



if (extension[1] == 'rar'):
    os.system("unrar x " + str(fileX))


if(extension[1] == 'zip'):
    os.system("unzip " + str(fileX))