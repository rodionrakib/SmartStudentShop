<?php 

namespace App\Repositories;

use App\Shop\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Jsdecena\Baserepo\BaseRepository;
use Illuminate\Http\UploadedFile;


class ProductRepository extends BaseRepository {
    
    public function __construct(Product $product) 
    {
        parent::__construct($product);
        $this->model = $product;
    }


    
    public function createProduct(array $data) : Product
    {
        try {
            return $this->create($data);
        } catch (QueryException $e) {
            throw new \Exception($e);
        }
    }


   /**
     * Update the product
     *
     * @param array $data
     *
     * @return bool
     */
    public function updateProduct(array $data) : bool
    {
        $filtered = collect($data)->except('image')->all();

        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            throw new ProductUpdateErrorException($e);
        }
    }


    public function saveCoverImage(UploadedFile $file):string
    {
        return $file->store('products',['disk'=>'public']);
    }
}