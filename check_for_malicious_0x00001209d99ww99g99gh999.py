import sys
import os
from os import listdir, walk
from os.path import isfile, join

import vt

import threading


class MainCheck():

    directory_to_check = ""

    api_key = "05d654e0aaa030e6d8a4da8718c8c6d49a88706076f831c4cbe8fbee9280bbaa"

    client = vt.Client(api_key)

    malicious_key_words = [
        "reverse", "shell","sock", "socket", "fsockopen", "fclose", "fopen", "fwrite",
        "popen", "procopen", "killall", "kill", "pkill", "bash", "python", "nc", "netcat", "system(",
    ]

    not_suspicious_file_types = [
         "html", "css", "js", "sass"
    ]

    blocked_file_Types = { 'py', 'lua', 'exe', 'sh', 'java' }


    def getAllFilesAndDirectories(self):
        f = []
        for (dirpath, dirnames, filenames) in walk(self.directory_to_check):
            for files in filenames:
                f.append("%s/%s" % (dirpath, files))

        return f

    def Scan_All_Files(self, files):
        for fileX in files:
            with open(fileX, 'rb') as f:
                results_of_scan = []
                analysis = self.client.scan_file(f, wait_for_completion=True)
                analysis = analysis.to_dict()

                for i in (analysis['attributes']['results']):
                    results_of_scan.append(analysis['attributes']['results'][i]['category'])
                
                
                if(results_of_scan.count("malicious") > 2):
                    # delete all folder and block user
                    f.close()
                    os.remove(fileX)
                    #block user

                    break
    
            try:
                f.close()
            except:
                pass

    def check_inside_contents(self, files):
        contents_of_each = []        

        acceptable_similarities = [
            'if', 'else', 'elif'
        ]
        
        for f in files:
            try:
                with open(f, 'r') as fileToRead:
                    
                    contents = [line.rstrip() for line in fileToRead]
                    
                    contents_of_each.append([f.replace("\\", "/"), contents])

                    
                            
                    fileToRead.close()
    

            except:
                pass

        for i in contents_of_each:
            for i2 in contents_of_each:

                if(i[1] == i2[1] and i[0] != i2[0]):
                    try:
                        #print("dpped filed")
                        os.remove(i[0])
                        pass
                    except:
                        pass
                    
                    pass
                #print(i[1], i2[1])


        
        #check similarities

        for lista in contents_of_each:
            fisier = lista[0]
            text_in_fisier = lista[1]
            
            for mal in self.malicious_key_words:
                if(text_in_fisier.count(mal) > 0):
                    os.remove(fisier)


            for lista_de_comparat in contents_of_each:

                comparat_text_in_fisier = lista_de_comparat[1]

                for cuvant in comparat_text_in_fisier:
                    if(fisier != lista_de_comparat[0]):
                        pass
                        if(text_in_fisier.count(cuvant) > (35/100) * len(text_in_fisier)):
                            os.remove(fisier)
                            print("exista aici ", text_in_fisier, cuvant, text_in_fisier.count(cuvant))
                    

                        
                        
                        



    def __init__(self):
        self.directory_to_check = sys.argv[1]

        files = self.getAllFilesAndDirectories()
    
        threading.Thread(target=self.check_inside_contents, args=(files,)).start()

        threading.Thread(target=self.Scan_All_Files, args=(files,)).start()



        

if __name__ == "__main__":
    MainCheck()