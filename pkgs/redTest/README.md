redTEST
=======

## Setup test development enviroment

### 1. Fork redTEST from github 
Or you can also skip this step just to test it.  
### 2. Clone your fork locally

In your desired folder (remember to replace it with your for URL if you forked the repo):  
<code>git clone git@github.com:redCOMPONENT-COM/redTEST.git</code>

### 3. Initialise submodules

<code>git submodule init</code>  
<code>git submodule update</code>

### 4. Update submodules

You can update your submodules anytime with:  

`git submodule foreach git pull origin master`

### 5. Install redTEST

Choose Install from folder in Joomla! and point to your redTEST folder  

### 6. Setup the phing build

redTEST includes its own build file to allow you to easilly keep all files updated (redTEST & redRAD).  

In the redTEST root folder you will find a <code>build.properties.dist</code>. Duplicate and rename it to <code>build.properties</code>. Then edit the file and set your desired www folder. That's the folder where the website will be exported for testing it.

Then setup your IDE to build anytime you need it. You can find more info at the main [redCOMPONENT documentation repo](https://github.com/redCOMPONENT-COM/documentation)