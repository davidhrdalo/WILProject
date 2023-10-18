<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Utils;

use Nette;


/**
 * Basic manipulation with images. Supported types are JPEG, PNG, GIF, WEBP, AVIF and BMP.
 *
 * <code>
 * $image = Image::fromFile('nette.jpg');
 * $image->resize(150, 100);
 * $image->sharpen();
 * $image->send();
 * </code>
 *
 * @method Image affine(array $affine, array $clip = null)
 * @method array affineMatrixConcat(array $m1, array $m2)
 * @method array affineMatrixGet(int $type, mixed $options = null)
 * @method void alphaBlending(bool $on)
 * @method void antialias(bool $on)
 * @method void arc($x, $y, $w, $h, $start, $end, $color)
 * @method void char(int $font, $x, $y, string $char, $color)
 * @method void charUp(int $font, $x, $y, string $char, $color)
 * @method int colorAllocate($red, $green, $blue)
 * @method int colorAllocateAlpha($red, $green, $blue, $alpha)
 * @method int colorAt($x, $y)
 * @method int colorClosest($red, $green, $blue)
 * @method int colorClosestAlpha($red, $green, $blue, $alpha)
 * @method int colorClosestHWB($red, $green, $blue)
 * @method void colorDeallocate($color)
 * @method int colorExact($red, $green, $blue)
 * @method int colorExactAlpha($red, $green, $blue, $alpha)
 * @method void colorMatch(Image $image2)
 * @method int colorResolve($red, $green, $blue)
 * @method int colorResolveAlpha($red, $green, $blue, $alpha)
 * @method void colorSet($index, $red, $green, $blue)
 * @method array colorsForIndex($index)
 * @method int colorsTotal()
 * @method int colorTransparent($color = null)
 * @method void convolution(array $matrix, float $div, float $offset)
 * @method void copy(Image $src, $dstX, $dstY, $srcX, $srcY, $srcW, $srcH)
 * @method void copyMerge(Image $src, $dstX, $dstY, $srcX, $srcY, $srcW, $srcH, $opacity)
 * @method void copyMergeGray(Image $src, $dstX, $dstY, $srcX, $srcY, $srcW, $srcH, $opacity)
 * @method void copyResampled(Image $src, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH)
 * @method void copyResized(Image $src, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH)
 * @method Image cropAuto(int $mode = -1, float $threshold = .5, int $color = -1)
 * @method void ellipse($cx, $cy, $w, $h, $color)
 * @method void fill($x, $y, $color)
 * @method void filledArc($cx, $cy, $w, $h, $s, $e, $color, $style)
 * @method void filledEllipse($cx, $cy, $w, $h, $color)
 * @method void filledPolygon(array $points, $numPoints, $color)
 * @method void filledRectangle($x1, $y1, $x2, $y2, $color)
 * @method void fillToBorder($x, $y, $border, $color)
 * @method void filter($filtertype)
 * @method void flip(int $mode)
 * @method array ftText($size, $angle, $x, $y, $col, string $fontFile, string $text, array $extrainfo = null)
 * @method void gammaCorrect(float $inputgamma, float $outputgamma)
 * @method array getClip()
 * @method int interlace($interlace = null)
 * @method bool isTrueColor()
 * @method void layerEffect($effect)
 * @method void line($x1, $y1, $x2, $y2, $color)
 * @method void openPolygon(array $points, int $num_points, int $color)
 * @method void paletteCopy(Image $source)
 * @method void paletteToTrueColor()
 * @method void polygon(array $points, $numPoints, $color)
 * @method array psText(string $text, $font, $size, $color, $backgroundColor, $x, $y, $space = null, $tightness = null, float $angle = null, $antialiasSteps = null)
 * @method void rectangle($x1, $y1, $x2, $y2, $col)
 * @method mixed resolution(int $res_x = null, int $res_y = null)
 * @method Image rotate(float $angle, $backgroundColor)
 * @method void saveAlpha(bool $saveflag)
 * @method Image scale(int $newWidth, int $newHeight = -1, int $mode = IMG_BILINEAR_FIXED)
 * @method void setBrush(Image $brush)
 * @method void setClip(int $x1, int $y1, int $x2, int $y2)
 * @method void setInterpolation(int $method = IMG_BILINEAR_FIXED)
 * @method void setPixel($x, $y, $color)
 * @method void setStyle(array $style)
 * @method void setThickness($thickness)
 * @method void setTile(Image $tile)
 * @method void string($font, $x, $y, string $s, $col)
 * @method void stringUp($font, $x, $y, string $s, $col)
 * @method void trueColorToPalette(bool $dither, $ncolors)
 * @method array ttfText($size, $angle, $x, $y, $color, string $fontfile, string $text)
 * @property-read positive-int $width
 * @property-read positive-int $height
 * @property-read \GdImage $imageResource
 */
class Image
{
	use Nette\SmartObject;

	/** Prevent from getting resized to a bigger size than the original */
	public const ShrinkOnly = 0b0001;

	/** Resizes to a specified width and height without keeping aspect ratio */
	public const Stretch = 0b0010;

	/** Resizes to fit into a specified width and height and preserves aspect ratio */
	public const OrSmaller = 0b0000;

	/** Resizes while bounding the smaller dimension to the specified width or height and preserves aspect ratio */
	public const OrBigger = 0b0100;

	/** Resizes to the smallest possible size to completely cover specified width and height and reserves aspect ratio */
	public const Cover = 0b1000;

	/** @deprecated use Image::ShrinkOnly */
	public const SHRINK_ONLY = self::ShrinkOnly;

	/** @deprecated use Image::Stretch */
	public const STRETCH = self::Stretch;

	/** @deprecated use Image::OrSmaller */
	public const FIT = self::OrSmaller;

	/** @deprecated use Image::OrBigger */
	public const FILL = self::OrBigger;

	/** @deprecated use Image::Cover */
	public const EXACT = self::Cover;

	/** @deprecated use Image::EmptyGIF */
	public const EMPTY_GIF = self::EmptyGIF;

	/** image types */
	public const
		JPEG = ImageType::JPEG,
		PNG = ImageType::PNG,
		GIF = ImageType::GIF,
		WEBP = ImageType::WEBP,
		AVIF = ImageType::AVIF,
		BMP = ImageType::BMP;

	public const EmptyGIF = "GIF89a\x01\x00\x01\x00\x80\x00\x00\x00\x00\x00\x00\x00\x00!\xf9\x04\x01\x00\x00\x00\x00,\x00\x00\x00\x00\x01\x00\x01\x00\x00\x02\x02D\x01\x00;";

	private const Formats = [ImageType::JPEG => 'jpeg', ImageType::PNG => 'png', ImageType::GIF => 'gif', ImageType::WEBP => 'webp', ImageType::AVIF => 'avif', ImageType::BMP => 'bmp'];

	private \GdImage $image;


	/**
	 * Returns RGB color (0..255) and transparency (0..127).
	 */
	public static function rgb(int $red, int $green, int $blue, int $transparency = 0): array
	{
		return [
			'red' => max(0, min(255, $red)),
			'green' => max(0, min(255, $green)),
			'blue' => max(0, min(255, $blue)),
			'alpha' => max(0, min(127, $transparency)),
		];
	}


	/**
	 * Reads an image from a file and returns its type in $type.
	 * @throws Nette\NotSupportedException if gd extension is not loaded
	 * @throws UnknownImageFileException if file not found or file type is not known
	 */
	public static function fromFile(string $file, ?int &$type = null): static
	{
		if (!extension_loaded('gd')) {
			throw new Nette\NotSupportedException('PHP extension GD is not loaded.');
		}

		$type = self::detectTypeFromFile($file);
		if (!$type) {
			throw new UnknownImageFileException(is_file($file) ? "Unknown type of file '$file'." : "File '$file' not found.");
		}

		return self::invokeSafe('imagecreatefrom' . self::Formats[$type], $file, "Unable to open file '$file'.", __METHOD__);
	}


	/**
	 * Reads an image from a string and returns its type in $type.
	 * @throws Nette\NotSupportedException if gd extension is not loaded
	 * @throws ImageException
	 */
	public static function fromString(string $s, ?int &$type = null): static
	{
		if (!extension_loaded('gd')) {
			throw new Nette\NotSupportedException('PHP extension GD is not loaded.');
		}

		$type = self::detectTypeFromString($s);
		if (!$type) {
			throw new UnknownImageFileException('Unknown type of image.');
		}

		return self::invokeSafe('imagecreatefromstring', $s, 'Unable to open image from string.', __METHOD__);
	}


	private static function invokeSafe(string $func, string $arg, string $message, string $callee): static
	{
		$errors = [];
		$res = Callback::invokeSafe($func, [$arg], function (string $message) use (&$errors): void {
			$errors[] = $message;
		});

		if (!$res) {
			throw new ImageException($message . ' Errors: ' . implode(', ', $errors));
		} elseif ($errors) {
			trigger_error($callee . '(): ' . implode(', ', $errors), E_USER_WARNING);
		}

		return new static($res);
	}


	/**
	 * Creates a new true color image of the given dimensions. The default color is black.
	 * @param  positive-int  $width
	 * @param  positive-int  $height
	 * @throws Nette\NotSupportedException if gd extension is not loaded
	 */
	public static function fromBlank(int $width, int $height, ?array $color = null): static
	{
		if (!extension_loaded('gd')) {
			throw new Nette\NotSupportedException('PHP extension GD is not loaded.');
		}

		if ($width < 1 || $height < 1) {
			throw new Nette\InvalidArgumentException('Image width and height must be greater than zero.');
		}

		$image = imagecreatetruecolor($width, $height);
		if ($color) {
			$color += ['alpha' => 0];
			$color = imagecolorresolvealpha($image, $color['red'], $color['green'], $color['blue'], $color['alpha']);
			imagealphablending($image, false);
			imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $color);
			imagealphablending($image, true);
		}

		return new static($image);
	}


	/**
	 * Returns the type of image from file.
	 * @return ImageType::*|null
	 */
	public static function detectTypeFromFile(string $file, &$width = null, &$height = null): ?int
	{
		[$width, $height, $type] = @getimagesize($file); // @ - files smaller than 12 bytes causes read error
		return isset(self::Formats[$type]) ? $type : null;
	}


	/**
	 * Returns the type of image from string.
	 * @return ImageType::*|null
	 */
	public static function detectTypeFromString(string $s, &$width = null, &$height = null): ?int
	{
		[$width, $height, $type] = @getimagesizefromstring($s); // @ - strings smaller than 12 bytes causes read error
		return isset(self::Formats[$type]) ? $type : null;
	}


	/**
	 * Returns the file extension for the given image type.
	 * @param  ImageType::*  $type
	 * @return value-of<self::Formats>
	 */
	public static function typeToExtension(int $type): string
	{
		if (!isset(self::Formats[$type])) {
			throw new Nette\InvalidArgumentException("Unsupported image type '$type'.");
		}

		return self::Formats[$type];
	}


	/**
	 * Returns the image type for given file extension.
	 * @return ImageType::*
	 */
	public static function extensionToType(string $extension): int
	{
		$extensions = array_flip(self::Formats) + ['jpg' => ImageType::JPEG];
		$extension = strtolower($extension);
		if (!isset($extensions[$extension])) {
			throw new Nette\InvalidArgumentException("Unsupported file extension '$extension'.");
		}

		return $extensions[$extension];
	}


	/**
	 * Returns the mime type for the given image type.
	 * @param  ImageType::*  $type
	 */
	public static function typeToMimeType(int $type): string
	{
		return 'image/' . self::typeToExtension($type);
	}


	/**
	 * @param  ImageType::*  $type
	 */
	public static function isTypeSupported(int $type): bool
	{
		return (bool) (imagetypes() & match ($type) {
			ImageType::JPEG => IMG_JPG,
			ImageType::PNG => IMG_PNG,
			ImageType::GIF => IMG_GIF,
			ImageType::WEBP => IMG_WEBP,
			ImageType::AVIF => 256, // IMG_AVIF,
			ImageType::BMP => IMG_BMP,
			default => 0,
		});
	}


	/**
	 * Wraps GD image.
	 */
	public function __construct(\GdImage $image)
	{
		$this->setImageResource($image);
		imagesavealpha($image, true);
	}


	/**
	 * Returns image width.
	 * @return positive-int
	 */
	public function getWidth(): int
	{
		return imagesx($this->image);
	}


	/**
	 * Returns image height.
	 * @return positive-int
	 */
	public function getHeight(): int
	{
		return imagesy($this->image);
	}


	/**
	 * Sets image resource.
	 */
	protected function setImageResource(\GdImage $image): static
	{
		$this->image = $image;
		return $this;
	}


	/**
	 * Returns image GD resource.
	 */
	public function getImageResource(): \GdImage
	{
		return $this->image;
	}


	/**
	 * Scales an image. Width and height accept pixels or percent.
	 * @param  int-mask-of<self::OrSmaller|self::OrBigger|self::Stretch|self::Cover|self::ShrinkOnly>  $mode
	 */
	public function resize(int|string|null $width, int|string|null $height, int $mode = self::OrSmaller): static
	{
		if ($mode & self::Cover) {
			return $this->resize($width, $height, self::OrBigger)->crop('50%', '50%', $width, $height);
		}

		[$newWidth, $newHeight] = static::calculateSize($this->getWidth(), $this->getHeight(), $width, $height, $mode);

		if ($newWidth !== $this->getWidth() || $newHeight !== $this->getHeight()) { // resize
			$newImage = static::fromBlank($newWidth, $newHeight, self::rgb(0, 0, 0, 127))->getImageResource();
			imagecopyresampled(
				$newImage,
				$this->image,
				0,
				0,
				0,
				0,
				$newWidth,
				$newHeight,
				$this->getWidth(),
				$this->getHeight(),
			);
			$this->image = $newImage;
		}

		if ($width < 0 || $height < 0) {
			imageflip($this->image, $width < 0 ? ($height < 0 ? IMG_FLIP_BOTH : IMG_FLIP_HORIZONTAL) : IMG_FLIP_VERTICAL);
		}

		return $this;
	}


	/**
	 * Calculates dimensions of resized image. Width and height accept pixels or percent.
	 * @param  int-mask-of<self::OrSmaller|self::OrBigger|self::Stretch|self::Cover|self::ShrinkOnly>  $mode
	 */
	public static function calculateSize(
		int $srcWidth,
		int $srcHeight,
		$newWidth,
		$newHeight,
		int $mode = self::OrSmaller,
	): array
	{
		if ($newWidth === null) {
		} elseif (self::isPercent($newWidth)) {
			$newWidth = (int) round($srcWidth / 100 * abs($newWidth));
			$percents = true;
		} else {
			$newWidth = abs($newWidth);
		}

		if ($newHeight === null) {
		} elseif (self::isPercent($newHeight)) {
			$newHeight = (int) round($srcHeight / 100 * abs($newHeight));
			$mode |= empty($percents) ? 0 : self::Stretch;
		} else {
			$newHeight = abs($newHeight);
		}

		if ($mode & self::Stretch) { // non-proportional
			if (!$newWidth || !$newHeight) {
				throw new Nette\InvalidArgumentException('For stretching must be both width and height specified.');
			}

			if ($mode & self::ShrinkOnly) {
				$newWidth = min($srcWidth, $newWidth);
				$newHeight = min($srcHeight, $newHeight);
			}
		} else {  // proportional
			if (!$newWidth && !$newHeight) {
				throw new Nette\InvalidArgumentException('At least width or height must be specified.');
			}

			$scale = [];
			if ($newWidth > 0) { // fit width
				$scale[] = $newWidth / $srcWidth;
			}

			if ($newHeight > 0) { // fit height
				$scale[] = $newHeight / $srcHeight;
			}

			if ($mode & self::OrBigger) {
				$scale = [max($scale)];
			}

			if ($mode & self::ShrinkOnly) {
				$scale[] = 1;
			}

			$scale = min($scale);
			$newWidth = (int) round($srcWidth * $scale);
			$newHeight = (int) round($srcHeight * $scale);
		}

		return [max($newWidth, 1), max($newHeight, 1)];
	}


	/**
	 * Crops image. Arguments accepts pixels or percent.
	 */
	public function crop(int|string $left, int|string $top, int|string $width, int|string $height): static
	{
		[$r['x'], $r['y'], $r['width'], $r['height']]
			= static::calculateCutout($this->getWidth(), $this->getHeight(), $left, $top, $width, $height);
		if (gd_info()['GD Version'] === 'bundled (2.1.0 compatible)') {
			$this->image = imagecrop($this->image, $r);
			imagesavealpha($this->image, true);
		} else {
			$newImage = static::fromBlank($r['width'], $r['height'], self::RGB(0, 0, 0, 127))->getImageResource();
			imagecopy($newImage, $this->image, 0, 0, $r['x'], $r['y'], $r['width'], $r['height']);
			$this->image = $newImage;
		}

		return $this;
	}


	/**
	 * Calculates dimensions of cutout in image. Arguments accepts pixels or percent.
	 */
	public static function calculateCutout(
		int $srcWidth,
		int $srcHeight,
		int|string $left,
		int|string $top,
		int|string $newWidth,
		int|string $newHeight,
	): array
	{
		if (self::isPercent($newWidth)) {
			$newWidth = (int) round($srcWidth / 100 * $newWidth);
		}

		if (self::isPercent($newHeight)) {
			$newHeight = (int) round($srcHeight / 100 * $newHeight);
		}

		if (self::isPercent($left)) {
			$left = (int) round(($srcWidth - $newWidth) / 100 * $left);
		}

		if (self::isPercent($top)) {
			$top = (int) round(($srcHeight - $newHeight) / 100 * $top);
		}

		if ($left < 0) {
			$newWidth += $left;
			$left = 0;
		}

		if ($top < 0) {
			$newHeight += $top;
			$top = 0;
		}

		$newWidth = min($newWidth, $srcWidth - $left);
		$newHeight = min($newHeight, $srcHeight - $top);
		return [$left, $top, $newWidth, $newHeight];
	}


	/**
	 * Sharpens image a little bit.
	 */
	public function sharpen(): static
	{
		imageconvolution($this->image, [ // my magic numbers ;)
			[-1, -1, -1],
			[-1, 24, -1],
			[-1, -1, -1],
		], 16, 0);
		return $this;
	}


	/**
	 * Puts another image into this image. Left and top accepts pixels or percent.
	 * @param  int<0, 100>  $opacity 0..100
	 */
	public function place(self $image, int|string $left = 0, int|string $top = 0, int $opacity = 100): static
	{
		$opacity = max(0, min(100, $opacity));
		if ($opacity === 0) {
			return $this;
		}

		$width = $image->getWidth();
		$height = $image->getHeight();

		if (self::isPercent($left)) {
			$left = (int) round(($this->getWidth() - $width) / 100 * $left);
		}

		if (self::isPercent($top)) {
			$top = (int) round(($this->getHeight() - $height) / 100 * $top);
		}

		$output = $input = $image->image;
		if ($opacity < 100) {
			$tbl = [];
			for ($i = 0; $i < 128; $i++) {
				$tbl[$i] = round(127 - (127 - $i) * $opacity / 100);
			}

			$output = imagecreatetruecolor($width, $height);
			imagealphablending($output, false);
			if (!$image->isTrueColor()) {
				$input = $output;
				imagefilledrectangle($output, 0, 0, $width, $height, imagecolorallocatealpha($output, 0, 0, 0, 127));
				imagecopy($output, $image->image, 0, 0, 0, 0, $width, $height);
			}

			for ($x = 0; $x < $width; $x++) {
				for ($y = 0; $y < $height; $y++) {
					$c = \imagecolorat($input, $x, $y);
					$c = ($c & 0xFFFFFF) + ($tbl[$c >> 24] << 24);
					\imagesetpixel($output, $x, $y, $c);
				}
			}

			imagealphablending($output, true);
		}

		imagecopy(
			$this->image,
			$output,
			$left,
			$top,
			0,
			0,
			$width,
			$height,
		);
		return $this;
	}


	/**
	 * Saves image to the file. Quality is in the range 0..100 for JPEG (default 85), WEBP (default 80) and AVIF (default 30) and 0..9 for PNG (default 9).
	 * @param  ImageType::*|null  $type
	 * @throws ImageException
	 */
	public function save(string $file, ?int $quality = null, ?int $type = null): void
	{
		$type ??= self::extensionToType(pathinfo($file, PATHINFO_EXTENSION));
		$this->output($type, $quality, $file);
	}


	/**
	 * Outputs image to string. Quality is in the range 0..100 for JPEG (default 85), WEBP (default 80) and AVIF (default 30) and 0..9 for PNG (default 9).
	 * @param  ImageType::*  $type
	 */
	public function toString(int $type = ImageType::JPEG, ?int $quality = null): string
	{
		return Helpers::capture(function () use ($type, $quality): void {
			$this->output($type, $quality);
		});
	}


	/**
	 * Outputs image to string.
	 */
	public function __toString(): string
	{
		return $this->toString();
	}


	/**
	 * Outputs image to browser. Quality is in the range 0..100 for JPEG (default 85), WEBP (default 80) and AVIF (default 30) and 0..9 for PNG (default 9).
	 * @param  ImageType::*  $type
	 * @throws ImageException
	 */
	public function send(int $type = ImageType::JPEG, ?int $quality = null): void
	{
		header('Content-Type: ' . self::typeToMimeType($type));
		$this->output($type, $quality);
	}


	/**
	 * Outputs image to browser or file.
	 * @param  ImageType::*  $type
	 * @throws ImageException
	 */
	private function output(int $type, ?int $quality, ?string $file = null): void
	{
		switch ($type) {
			case ImageType::JPEG:
				$quality = $quality === null ? 85 : max(0, min(100, $quality));
				$success = @imagejpeg($this->image, $file, $quality); // @ is escalated to exception
				break;

			case ImageType::PNG:
				$quality = $quality === null ? 9 : max(0, min(9, $quality));
				$success = @imagepng($this->image, $file, $quality); // @ is escalated to exception
				break;

			case ImageType::GIF:
				$success = @imagegif($this->image, $file); // @ is escalated to exception
				break;

			case ImageType::WEBP:
				$quality = $quality === null ? 80 : max(0, min(100, $quality));
				$success = @imagewebp($this->image, $file, $quality); // @ is escalated to exception
				break;

			case ImageType::AVIF:
				$quality = $quality === null ? 30 : max(0, min(100, $quality));
				$success = @imageavif($this->image, $file, $quality); // @ is escalated to exception
				break;

			case ImageType::BMP:
				$success = @imagebmp($this->image, $file); // @ is escalated to exception
				break;

			default:
				throw new Nette\InvalidArgumentException("Unsupported image type '$type'.");
		}

		if (!$success) {
			throw new ImageException(Helpers::getLastError() ?: 'Unknown error');
		}
	}


	/**
	 * Call to undefined method.
	 * @throws Nette\MemberAccessException
	 */
	public function __call(string $name, array $args): mixed
	{
		$function = 'image' . $name;
		if (!function_exists($function)) {
			ObjectHelpers::strictCall(static::class, $name);
		}

		foreach ($args as $key => $value) {
			if ($value instanceof self) {
				$args[$key] = $value->getImageResource();

			} elseif (is_array($value) && isset($value['red'])) { // rgb
				$args[$key] = imagecolorallocatealpha(
					$this->image,
					$value['red'],
					$value['green'],
					$value['blue'],
					$value['alpha'],
				) ?: imagecolorresolvealpha(
					$this->image,
					$value['red'],
					$value['green'],
					$value['blue'],
					$value['alpha'],
				);
			}
		}

		$res = $function($this->image, ...$args);
		return $res instanceof \GdImage
			? $this->setImageResource($res)
			: $res;
	}


	public function __clone()
	{
		ob_start(function () {});
		imagepng($this->image, null, 0);
		$this->setImageResource(imagecreatefromstring(ob_get_clean()));
	}


	private static function isPercent(int|string &$num): bool
	{
		if (is_string($num) && str_ends_with($num, '%')) {
			$num = (float) substr($num, 0, -1);
			return true;
		} elseif (is_int($num) || $num === (string) (int) $num) {
			$num = (int) $num;
			return false;
		}

		throw new Nette\InvalidArgumentException("Expected dimension in int|string, '$num' given.");
	}


	/**
	 * Prevents serialization.
	 */
	public function __sleep(): array
	{
		throw new Nette\NotSupportedException('You cannot serialize or unserialize ' . self::class . ' instances.');
	}
}
