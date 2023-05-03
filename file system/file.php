<?php

$file = "file.txt";

// LINKED TO GET OUTPUT OF (pathinfo($file,PATHINFO_EXTENSION));
$file = realpath("file.txt");


filesize() --- to check the size of a file
echo filesize($file);
$nk = mkdir("creatingfile");
echo filetype("creatingfile");
echo realpath("creatingfile");
echo filetype($file);
echo "<pre>";

//LINKED 
print_r(pathinfo($file,PATHINFO_EXTENSION));
echo "<pre>";

echo basename($file,".txt");
echo dirname($file,4);

// read and write properties

if(file_exists($file)){
    // 1. readfile() 
    echo readfile($file); 
    // 2. copy()
    copy("textfile.txt","copyofexisting.txt");
    // 3. rename()
    rename("copyofexisting.txt","renameofexisting.txt");
    // 4. unlink()
    unlink("textfile.txt");
    echo "File Deleted Successfully";
    // 5. delete()
    delete("textfile.txt");
}
else{
    echo "file not exist";
}


// creating folder or removing properties

// mkdir() --- creating Directory 
$dir = mkdir("newfolder");
if(!file_exists($dir)){
    mkdir($dir);
    echo "Created Succesfully";
}
else{
    echo "Folder Already Created";
}

// rmdir() --- removing Directory 
if(file_exists("1")){
    rmdir("1");
    echo "remove Succesfully";
}
else{
    echo "Folder not exist";
}




?>