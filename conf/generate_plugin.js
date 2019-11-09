const fs = require('fs');
const path = require('path');

const rootPath = path.join(process.cwd());
const pluginPackage = require(path.join(rootPath, 'package.json'));

const pluginName = pluginPackage.name;
const pluginSlug = pluginPackage.slug;
const pluginConst = pluginPackage.const;

/**
* Recursively traverse through the plugin folders to rename necessary areas
* with the real plugin name
**/
const traverseFolders = async(curPath) => {
  // Get all files in the current folder
  const files = fs.readdirSync(curPath);

  // Filter files that need renaming
  const renameItems = files.filter((file) => file.includes('@plugin-name@'));
  await renameFiles(curPath, renameItems);

  // Filter php files that need renaming within the files
  const renameInnerFiles = files.filter((file) => file.includes('.php'));
  // Rename everything within the files
  await innerRename(curPath, renameInnerFiles);
}

const renameFiles = (curPath, files) => {
  return new Promise((resolve) => {
    if (files.length) {
      files.forEach((fileName, indx) => {
        const newName = fileName.replace('@plugin-name@', pluginName);
        fs.renameSync(path.join(curPath, fileName), path.join(curPath, newName));
        if (indx == files.length - 1) {
          resolve();
        }
      });
    } else {
      resolve();
    }
  });
}

const innerRename = (curPath, files) => {
  return new Promise((resolve) => {
    if (files.length) {
      files.forEach((fileName, indx) => {
        const filePath = path.join(curPath, fileName);
        const fileData = fs.readFileSync(filePath, 'utf8');
        var result = fileData.replace(/@plugin-name@/g, pluginName);
        result = result.replace(/@plugin-slug@/g, pluginSlug);
        result = result.replace(/@plugin-const@/g, pluginConst);
        fs.writeFileSync(filePath, result, 'utf8');
        
        if (indx == files.length - 1) {
          resolve();
        }
      });
    } else {
      resolve();
    }
  });
}

// BLAST OFF
traverseFolders(rootPath);
