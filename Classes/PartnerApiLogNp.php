<?php
    class PartnerApiLogNp extends PartnerApiLogAbstract
    {
        public function save()
        {
            foreach($this->errors as $error)
            {
                Db::i()->insert('partner_errors',
                    array(
                        'message' => $error,
                        'alias' => 'np',
                        'record_id' => $this->record_id,
                        'date' => Db::i()->now(),
                        'last_request' => $this->last_request,
                        'last_response' => $this->last_response
                    )
                );

                Tools::report( $error, 'Partner API Error' );
            }

            foreach ($this->requests as $request)
            {
                Db::i()->insert('partner_requests',
                    array(
                        'request' => $request['request'],
                        'response' => $request['response'],
                        'function' => $request['function'],
                        'alias' => 'np',
                        'record_id' => $this->record_id,
                        'date' => Db::i()->now()
                    )
                );
            }
        }
    }
?>