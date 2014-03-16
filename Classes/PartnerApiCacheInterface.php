<?php
    interface PartnerApiCacheInterface
    {
        public function getBranches( $town_id, $address_id, $weight );

        public function getRandomBranch( $town_id, $address_id );

        public function getBranchData($branch_id);

        public function addBrach( $brach_data );
    }
?>