#send photos to gallery server

import glob
import os
import getpass

#------------------------------------------------------------------------
maindir = "/home/" + getpass.getuser() + "/photos-upload/" #where the photos and count file will be, use absolute paths
offsiteloc = "server.com:/var/www/location/of/photos/" #the server to send to include exact path "myserver.com:/var/www/photos/"
#------------------------------------------------------------------------

if len(maindir) != 0:
	if maindir[-1] != "/":
		maindir = maindir + "/"

if len(offsiteloc) != 0:
	if offsiteloc[-1] != "/":
		offsiteloc = offsiteloc + "/"

if os.path.exists(maindir) == False:
	os.makedir(maindir)

if os.path.exists(maindir + "count.txt") == False:
	with open(maindir + "count.txt","w") as handle:
		handle.write("0")

if os.path.exists(maindir + "old/") == False:
	os.system("mkdir " + maindir + "old/")

with open(maindir + "count.txt","r") as handle:
	count = int(handle.read())

files = glob.glob(maindir + "*")

photos = []
for x in files:
	if ".jpg" in x or ".JPG" in x:
		if x[-4:] == ".jpg" or x[-4:] == ".JPG":
			photos.append(x)

if len(photos) == 0:
	print "Could not find any photos"
else:
	for x in photos:
		os.system("mogrify -quality 100 -auto-orient -resize 640 " + x)
		os.system("mv " + x + " " + maindir + str(count) + ".jpg")
		count += 1

	with open(maindir + "count.txt","w") as handle:
		handle.write(str(count))
	os.system("rsync -ave ssh " + maindir + "*.jpg " + offsiteloc)
	os.system("mv " + maindir + "*.jpg " + maindir + "old/")
	print "Finished Uploading images."
