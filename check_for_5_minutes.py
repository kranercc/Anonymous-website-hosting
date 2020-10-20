import os
import time

while 1:
    for i in (os.listdir('uploads/')):
        if(time.time() - os.path.getctime("uploads/" +str(i)) > 300):
            os.system('rm -rf uploads/' + str(i))

    time.sleep(10)