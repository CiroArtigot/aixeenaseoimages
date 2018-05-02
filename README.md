
Aixeena SEO Images
===============

1.- Description
---------------------------  

**Aixeena SEO Images** is free Joomla plugin to minimize the weight of the images of your site.

With this plugin you can get better results in the performance of your website, because it creates thumbnails of your images, reducing their size and quality.

The plugin is thinked for Joomla developers who need or love to increase the perfomance of their sites.

This plugin is created by [Ciro Artigot](http://twitter/ciroartigot) to contribute to the Joomla community.

2.- Features
---------------------------
* It works with jpeg and png images, you can minize the size and the quality.
* The thumbs are stored on a local folder (images/thumbs/ by default) and repalced on the page content.
* The plugin only work with local images.
* You can set the default images qualities and maximum image size, and you can set the default thumb directory.
* By default you must add some tag classes to make it work. You can also disable de option "A Class is mandatory" to minimize all the page images.
* The plugin works also with <img> tags and with style="background-image:url(), it can resize both of them.

## Mandatory classes:

In the option "A class is mandatory" is enabled (it´s by default) is mandatory to add some classes to the <img> or to the element with the style.

To minimize an image you must add the "aixeena-images" class.

To set the maximun size enter the "size-200" (to set the maximum size to 200px). This way you can resize by code each image in a different size. You can have different views for different displais (mobile, desktop...)

To override the default quality you can use the "quality-80" to, for example set the quality to 80%.

So you can resize an image to 300px and 60% quality with:

```bash
<img src="images/xxxxx.jpg" class="aixeena-images size-300 quality-60" /></code>
```

This will create a thumbnail in the images/thumbs directory and the img src attribute will be replaced with the thumb path.

### Minimize style background images

You can also minimize the images linked with the backgound-image CSS property.

Add the aixeena-background class to the item tag that have the style:

```bash
<div class="aixeena-background aixeena-images size-215 quality-100" style="background-image:url(images/xxxx); "></div>
```
## Notes:

* There is no way now to delete the thumbs by button, so if you want to replace the thumb of a image, delete it from the thumbs folder or change the image name (a new thumb will be generated)
* I'm looking to create a delete option to delete the thumbs by url, and to delete all too.
* It will be nice that someone can do a pull request of thie readme file to improve the engish redaction.

## Contact:

* The Aixeena Web Page is on construction so if you want to contact me you can do it on twitter or Linked in
* https://twitter.com/CiroArtigot
https://www.linkedin.com/in/ciroartigot

## Licence

* This sofware is free and GPU licensed

** Donate

* You can donate and help my with a beer or a cup of coffe to continue developing free an opensource for Joomla!
