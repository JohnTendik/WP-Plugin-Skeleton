const fs = require('fs');
const path = require('path');

const rootPath = path.join(process.cwd());
const pluginPackage = require(path.join(rootPath, 'package.json'));

const pluginName = pluginPackage.name;
const pluginSlug = pluginPackage.slug;

/**
* Recursively traverse through the plugin folders to rename necessary areas
* with the real plugin name
**/
const traverseFolders = (curPath) => {
  // Get all files in the current folder
  const files = fs.readdirSync(curPath);

  // Filter files that need renaming
  const renameItems = files.filter((file) => file.includes('@plugin-name@'));
  if (renameFiles.length) {
    // Rename the files
    renameFiles(curPath, renameItems);
  }

  // Filter php files that need renaming within the files
  const renameInnerFiles = files.filter((file) => file.includes('.php'));
  if (renameInnerFiles.length) {
    // Rename everything within the files
    innerRename(curPath, renameInnerFiles);
  }
}

const renameFiles = (curPath, files) => {
  files.forEach(fileName => {
    const newName = fileName.replace('@plugin-name@', pluginName);
    fs.renameSync(path.join(curPath, fileName), path.join(curPath, newName));
  });
}

const innerRename = (curPath, files) => {
  files.forEach(fileName => {
    const filePath = path.join(curPath, fileName);
    fs.readFile(filePath, 'utf8', function (err,data) {
      if (err) {
        return console.log(err);
      }
      var result = data.replace(/@plugin-name@/g, pluginName);
      result = result.replace(/@plugin-slug@/g, pluginSlug);

      fs.writeFile(filePath, result, 'utf8', function (err) {
        if (err) return console.log(err);
      });
    });
  });
}

// BLAST OFF
traverseFolders(rootPath);
