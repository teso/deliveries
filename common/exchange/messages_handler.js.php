<?php
    $noEcho = true;

    include_once( "../../settings.add.php" );
    include_once( PHP_ROOT . "/system/config.add.php" );
    include_once( PHP_ROOT . "/system/systemUpdate.php" );
    include_once( PHP_ROOT . "/interface/loadlang.php" );
    include_once( PHP_ROOT . '/system/standart.add.php' );

    loadlang( 'el', PHP_ROOT . '/common/exchange/lang/' );

    $action = !empty( $_POST['action'] ) ? $_POST['action'] : null;
    $section = !empty( $_POST['section'] ) ? $_POST['section'] : null;
    $record_id = !empty( $_POST['record_id'] ) ? (int)$_POST['record_id'] : 0;
    $parent_id = !empty( $_POST['parent_id'] ) ? (int)$_POST['parent_id'] : 0;
    $message = !empty( $_POST['message'] ) ? $_POST['message'] : null;
    $is_deleted = !empty( $_POST['is_deleted'] ) ? $_POST['is_deleted'] : false;
    $owner_id = ExchangeMessages::getOwner( $record_id );

    $oMessages = new ExchangeMessages( $section, $record_id, $OficialUserId, $owner_id );

    switch( $action )
    {
        case 'save' :
            $message_id = $oMessages->saveMessage( $parent_id, $message );

            if( 0 < $message_id )
            {
                $message_html = parseTemplate( PHP_ROOT . '/common/exchange/tpl/message.tpl', array(
                    'section' => $section,
                    'record_id' => $record_id,
                    'guest_id' => $OficialUserId,
                    'owner_id' => $owner_id,
                    'is_adder' => true,     //TODO Прибрати, задавати starter_id
                    'data' => array(
                        'id' => $message_id,
                        'parent_id' => $parent_id,
                        'user_id' => $OficialUserId,
                        'starter_id' => null,
                        'adddate' => date( 'Y-m-d H:i:s' ),
                        'message' => $message,
                    ),
                    'child_messages' => ''
                ) );

                echo Tools::json_encode( array( 'result' => 1, 'html' => $message_html ) );

                Tools::report( 'USER_ID: ' . $OficialUserId . chr( 10 ) . 'PAGE: ' . HTTP_ROOT . ('freight' == $section ? '/loads/' : '/vehicles/') . $record_id . chr( 10 ) . (0 < $parent_id ? 'RESPONSE: ' : 'QUESTION: ' ) . $message, 'Exchange messages' );
            }
            break;
        case 'delete' :
            if( $oMessages->deleteMessage( $parent_id, $is_deleted ) )
            {
                echo Tools::json_encode( array( 'result' => 1 ) );
            }
            else
            {
                echo Tools::json_encode( array( 'result' => 2 ) );
            }
        default :
            break;
    }