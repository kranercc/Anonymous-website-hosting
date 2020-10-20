import os
import time

def get_directory_size(directory):
    """Returns the `directory` size in bytes."""
    total = 0
    try:
        # print("[+] Getting the size of", directory)
        for entry in os.scandir(directory):
            if entry.is_file():
                # if it's a file, use stat() function
                total += entry.stat().st_size
            elif entry.is_dir():
                # if it's a directory, recursively call this function
                total += get_directory_size(entry.path)
    except NotADirectoryError:
        # if `directory` isn't a directory, get the file size then
        return os.path.getsize(directory)
    except PermissionError:
        # if for whatever reason we can't open the folder, return 0
        return 0
    return total



uploads_directory = "uploads/"


while 1:
    for d in os.listdir(uploads_directory):
        if (get_directory_size(uploads_directory+d)/1000000) > 50:
            
            os.system("echo \"removed dir: \"" + uploads_directory+d + " from user: " + f.readlines()[0] + " >> log.txt" )   
            os.system("rm -rf %s" % (uploads_directory+d))

        
    time.sleep(1)
