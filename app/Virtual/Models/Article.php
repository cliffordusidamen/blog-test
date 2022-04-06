<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Article",
 *     description="Article model",
 *     @OA\Xml(
 *         name="Article"
 *     )
 * )
 */
class Article
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *     title="Title",
     *     description="Title",
     *     example="Article title"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *     title="Body",
     *     description="Body",
     *     example="Article body"
     * )
     *
     * @var string
     */
    public $body;

    /**
     * @OA\Property(
     *     title="Cover image",
     *     description="Cover image",
     *     example="https://via.placeholder.com/800.png"
     * )
     *
     * @var string
     */
    public $cover_image;

    /**
     * @OA\Property(
     *     title="Cover thumbnail",
     *     description="Cover thumbnail",
     *     example="https://via.placeholder.com/200.png"
     * )
     *
     * @var string
     */
    public $cover_thumbnail;

    /**
     * @OA\Property(
     *     title="Views",
     *     description="Views",
     *     format="int64",
     *     example=0
     * )
     *
     * @var integer
     */
    public $views;

    /**
     * @OA\Property(
     *     title="Published datetime",
     *     description="Published datetime",
     *     format="string",
     *     example="2022-04-05 14:04:34",
     * )
     */
    public $published_at;

    /**
     * @OA\Property(
     *     title="Created datetime",
     *     description="Created datetime",
     *     format="string",
     *     example="2022-04-05 13:04:34",
     * )
     */
    public $created_at;

    /**
     * @OA\Property(
     *     title="Updated datetime",
     *     description="Date time it was last updated",
     *     format="string",
     *     example="2022-04-05 16:04:34",
     * )
     */
    public $updated_at;


}