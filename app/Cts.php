<?php


namespace App;

//Constants Class

class Cts
{
    const NODE_CAN_LINK_TO_ITSELF = false;
    const UNI_DIRECTION_ONLY = true;
    const MILTI_EDGE_BETWEEN_2_NODES = false;
    const ALLOW_STRANDED_NODES = false;
    const MAX_NODES_REQUESTED = 100;

    //http statuses
    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_CREATED = 201;
    const HTTP_STATUS_UNAUTHORIZED = 401;
    const HTTP_UNPROCESSABLE_ENTITY = 422;
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_SERVER_ERROR = 500 ;

    //matrix
    const MATRIX_SIZE_MAX = 1000;

}
