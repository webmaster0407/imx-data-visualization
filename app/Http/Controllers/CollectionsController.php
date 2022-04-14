<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    /*
        @usage : display Collections
        @params: 
        @return: view
    */
    public function index() {

    }

    /*
        @name  : getCollections
        @usage : Get a list of collections
        @params: 
            body params:
                integer  page_size  :  Page size of the result
                string  cursor : Cursor
                string  order_by : Property to sort by
                string  direction : Direction to sort(asc/desc)
                string  blacklist : List of collections not to be displayed, separated by commas
        @return: 
            {
              "result": [
                {
                  "address": "0xfc07fb6a7bd562fe6dd84d087256f883e59c6073",
                  "name": "MAN-298",
                  "description": "Coleccion para validar la integracion de Reducir costos de minteo en los contratos",
                  "icon_url": "https://mantial-collections-production.s3.amazonaws.com/0xfc07fb6a7bd562fe6dd84d087256f883e59c6073/icon.img",
                  "collection_image_url": "https://mantial-collections-production.s3.amazonaws.com/0xfc07fb6a7bd562fe6dd84d087256f883e59c6073/icon.img",
                  "project_id": 12451,
                  "metadata_api_url": "https://staging.api.immutable.mantial.io/assets/imx/0xfc07fb6a7bd562fe6dd84d087256f883e59c6073"
                },
                ...
              ],
              "cursor": "eyJhZGRyZXNzIjoiMHhkNDJiNzgxZGUzMzMxYTRlNzg2YjFkNGU3MmI1ZDc1NTJiM2UzMzJjIiwibmFtZSI6Inp6VGVzdCIsImNyZWF0ZWRfYXQiOiIyMDIyLTAzLTI0VDAzOjE5OjEwLjM0MTkzM1oiLCJ1cGRhdGVkX2F0IjoiMjAyMi0wMy0yNFQwNDoxMzowMC4zMjM2WiIsIkNvbGxlY3Rpb25JbWFnZVVybCI6Imh0dHBzOi8vZ2F0ZXdheS5waW5hdGEuY2xvdWQvaXBmcy9zZFB2SnZZQk5zSlFQVUw4VVh5ZHZRN1c2dzh5TkM3bWZxcFh0Qlhzemp3NkR1IiwicHJvamVjdF9pZCI6Mjc1MDEsIm1ldGFkYXRhX2FwaV91cmwiOiJodHRwczovL2dhdGV3YXkucGluYXRhLmNsb3VkL2lwZnMvUW1RY2FTMWRWcFYyRWpuOGZuNW52RHBkNktObkFGbzlCZmZNWmdkVGR2cVZxMiJ9",
              "remaining": 1
            }
    */
    public function _getCollections(Request $request) {
        $body = [];
        if ($request->page_size !== null) {
            $body['page_size'] = $request->page_size;
        }
        if ($request->cursor !== null) {
            $body['cursor'] = $request->cursor;
        }
        if ($request->order_by !== null) {
            $body['order_by'] = $request->order_by;
        }
        if ($request->direction !== null) {
            $body['direction'] = $request->direction;
        }
        if ($request->blacklist !== null) {
            $body['blacklist'] = $request->blacklist;
        }

        $response = Http::acceptJson()
        ->get(
            'https://api.ropsten.x.immutable.com/v1/collections',
            $body
        );
        echo $response->getBody();
    }


    /*
        @name  : createCollection
        @method: post
        @usage : get all applications
        @params: 
            body params: 
                contract_address  required  :  Ethereum address of the ERC721 contract
                name required : Name of the collection
                owner_public_key required : Owner Public Key: The public key of the owner of the contract
                collection_image_url : URL of the tile image for this collection
                description : Description of the collection
                icon_url : URL of the icon for this collection
                metadata_api_url : URL of the metadata for this collection
        @return: 
            //
    */
    public function _createCollection(Request $request) {
        $body = [];
        $body['contract_address'] = $request->contract_address;
        $body['name'] = $request->name;
        $body['owner_public_key'] = $request->owner_public_key;

        if ($request->collection_image_url !== null) {
            $body['collection_image_url'] = $request->collection_image_url;
        }
        if ($request->description !== null) {
            $body['description'] = $request->description;
        }
        if ($request->icon_url !== null) {
            $body['icon_url'] = $request->icon_url;
        }
        if ($request->metadata_api_url !== null) {
            $body['metadata_api_url'] = $request->metadata_api_url;
        }   
        $response = Http::acceptJson()
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post(
                'https://api.ropsten.x.immutable.com/v1/collections',
                $body
            );
        echo $response->getBody();
    }

    /*
        @name  : getCollection
        @usage : Get details of a collection at the given address
        @params: 
            path params: 
                $address : Collection contract address
        @return: 
            {
              "address": "0xfc07fb6a7bd562fe6dd84d087256f883e59c6073",
              "name": "MAN-298",
              "description": "Coleccion para validar la integracion de Reducir costos de minteo en los contratos",
              "icon_url": "https://mantial-collections-production.s3.amazonaws.com/0xfc07fb6a7bd562fe6dd84d087256f883e59c6073/icon.img",
              "collection_image_url": "https://mantial-collections-production.s3.amazonaws.com/0xfc07fb6a7bd562fe6dd84d087256f883e59c6073/icon.img",
              "project_id": 12451,
              "metadata_api_url": "https://staging.api.immutable.mantial.io/assets/imx/0xfc07fb6a7bd562fe6dd84d087256f883e59c6073"
            }
    */
    public function _getCollection($address) {
        $response = Http::acceptJson()
        ->get(
            'https://api.ropsten.x.immutable.com/v1/collections/' . $address
        );
        echo $response->getBody();
    }

    /*
        @name  : updateCollection
        @method: post
        @usage : Update collection
        @params: 
            body params:
                string  collection_image_url : URL of the tile image for this collection
                string  description : Description of the collection
                string  icon_url : URL of the icon for this collection
                string  metadata_api_url : URL of the metadata for this collection
                string  name : Name of the collection
        @return: 
            //
    */
    public function _updateCollection(Request $request, $address) {
        $body = [];
        if ($request->collection_image_url !== null) {
            $body['collection_image_url'] = $request->collection_image_url;
        }
        if ($request->description !== null) {
            $body['description'] = $request->description;
        }
        if ($request->icon_url !== null) {
            $body['icon_url'] = $request->icon_url;
        }
        if ($request->metadata_api_url !== null) {
            $body['metadata_api_url'] = $request->metadata_api_url;
        } 
        if ($request->name !== null) {
            $body['name'] = $request->name;
        } 

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post(
                'https://api.ropsten.x.immutable.com/v1/collections/' . $address,
                $body
            );
        echo $response->getBody();
    }


    /*
        @name  : get_list_collection_filters
        @usage : Get a list of collection filters
        @params: 
            path params:
                $address required : Collection contract address
            body params:
                integer page_size  :  Page size of the result
                string  next_page_token : Next page token
        @return: 
            []
    */
    public function _get_list_collection_filters(Request $request, $address) {
        $body = [];
        if ($request->page_size !== null) {
            $body['page_size'] = $request->page_size;
        }
        if ($request->next_page_token !== null) {
            $body['next_page_token'] = $request->next_page_token;
        }

        $response = Http::acceptJson()
            ->get(
                'https://api.ropsten.x.immutable.com/v1/collections/' . $address . '/filters',
                $body
            );
        echo $response->getBody();
    }


    /*
        @name  : get_collection_metadataSchema
        @usage : Get collection metadata schema
        @params: 
            $address required : Collection contract address
        @return: 
            []
    */
    public function _get_collection_metadataSchema($address) {

        $response = Http::acceptJson()
            ->get(
                'https://api.ropsten.x.immutable.com/v1/collections/' . $address . '/metadata-schema',
            );
        echo $response->getBody();
    }

    /*
        @name  : add_metadataSchema_to_collection
        @method: post
        @usage : Add metadata schema to collection
        @params: 
            path parmas:
                $address required : Collection contract address
            body params: 
                object metadata required: 
                    boolean filterable : Sets the metadata as filterable
                    string name required : Name of the metadata key
                    string type : Type of the metadata. Values: "enum", "text", "boolean", "continuous", "discrete" | Default: "text". Src: https://docs.x.immutable.com/docs/asset-metadata#property-type-mapping
        @return: 
            //
    */
    public function _add_metadataSchema_to_collection(Request $request, $address) {
        
        $metadata = $request->metadata;
        // if ($request->filterable !== null) {
        //     $body['metadata']['filterable'] = $request->filterable;
        // }
        // if ($request->type !== null) {
        //     $body['metadata']['type'] = $request->type;
        // }

        $body['metadata'] = [];

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post(
                'https://api.ropsten.x.immutable.com/v1/collections/' . $address . '/metadata-schema',
                $body
            );
        echo $response->getBody();
    }

    /*
        @name  : update_metadataSchema_by_name
        @method: post
        @usage : Update metadata schema by name
        @params: 
            path params: 
                $address required : Collection contract address
                $name required : Metadata schema name
            body params:
                string name required: Name of the metadata key
                boolean filterable: Sets the metadata as filterable
                string type: Type of the metadata. Values: "enum", "text", "boolean", "continuous", "discrete" | Default: "text". Src: https://docs.x.immutable.com/docs/asset-metadata#property-type-mapping
        @return: 
            //
    */
    public function _update_metadataSchema_by_name(Request $request, $address, $schemaName)
    {
        $body = [];
        $metadata = [];
        $metadata['name'] = $request->name;
        if ($request->filterable !== null) {
            $metadata['filterable'] = $request->filterable;
        }
        if ($request->type !== null) {
            $metadata['type'] = $request->type;
        }
        $body[0] = $metadata;


        $response = Http::acceptJson()
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post(
                'https://api.ropsten.x.immutable.com/v1/collections/' . $address . '/metadata-schema/' . $schemaName,
                $body
            );
        echo $response->getBody();
    }




}
