const mix = require('laravel-mix');
const fs = require('fs');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

function addJs(source, target) {
    for (let inode of fs.readdirSync(source)) {
        let stats = fs.statSync(path.join(source, inode));

        if (stats.isFile()) {
            if (/\.min\.js$/i.exec(inode) ||/\.map$/i.exec(inode) )
                mix.copy(path.join(source, inode), path.join(target, inode));
            else if (/\.js$/i.exec(inode))
                mix.js(path.join(source, inode), path.join(target, inode));
        } else {
            addJs(path.join(source, inode), path.join(target, inode));
        }
    }
}

addJs('resources/js', 'public/js');
