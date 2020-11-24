const fs = require('fs');
const path = require('path');

const rootPath = path.join(process.cwd());
const pluginPackage = require(path.join(rootPath, 'package.json'));

const pluginName = pluginPackage.name;
const pluginSlug = pluginPackage.slug;
const pluginNamePretty = pluginPackage.prettyName;
const pluginConst = pluginPackage.const;
const pluginClassName = pluginPackage.className;

/**
* Recursively traverse through the plugin folders to rename necessary areas
* with the real plugin name
**/
const traverseFolders = async(curPath) => {
  // Get all files in the current folder
  const files = fs.readdirSync(curPath);
  files.reduce(async(prevPromise, filePath) => {
    let fullPath = path.join(curPath, filePath);
    if (filePath.includes('.php')) {
      await innerRename(curPath, filePath)
    }
    if (filePath.includes('@plugin-name@')) {
      fullPath = await renameFile(curPath, filePath);
    }
    if (fs.statSync(fullPath) && fs.statSync(fullPath).isDirectory() && filePath !== '.git') {
      traverseFolders(fullPath)
    }
    Promise.resolve();
  }, Promise.resolve());
  
}

const renameFile = (curPath, filePath) => {
  return new Promise((res) => {
    const newName = filePath.replace('@plugin-name@', pluginName);
    fs.renameSync(path.join(curPath, filePath), path.join(curPath, newName));
    res(path.join(curPath, newName));
  });
}

const innerRename = (curPath, filePathArg) => {
  return new Promise((res) => {
    const filePath = path.join(curPath, filePathArg);
    const fileData = fs.readFileSync(filePath, 'utf8');
    var result = fileData.replace(/@plugin-name@/g, pluginName);
    result = result.replace(/@plugin-slug@/g, pluginSlug);
    result = result.replace(/@plugin-name-pretty@/g, pluginNamePretty);
    result = result.replace(/@plugin-const@/g, pluginConst);
    result = result.replace(/@plugin-className@/g, pluginClassName);
    fs.writeFileSync(filePath, result, 'utf8');
    res();
  });
}

// BLAST OFF
traverseFolders(rootPath);
