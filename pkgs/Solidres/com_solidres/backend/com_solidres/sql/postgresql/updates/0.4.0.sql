ALTER TABLE  "#__sr_media_reservation_assets_xref" ADD COLUMN "weight" integer NOT NULL DEFAULT 0;
ALTER TABLE  "#__sr_media_roomtype_xref" ADD COLUMN "weight" integer NOT NULL DEFAULT 0;
ALTER TABLE  "#__sr_reservation_asset_fields" CHANGE COLUMN  "field_value"  "field_value" TEXT NULL DEFAULT NULL;
ALTER TABLE  "#__sr_room_type_fields" CHANGE COLUMN "field_value"  "field_value" TEXT NULL DEFAULT NULL;
ALTER TABLE  "#__sr_prices" CHANGE "customer_group_id"  "customer_group_id" integer NULL DEFAULT NULL;
ALTER TABLE  "#__sr_customers" CHANGE  "customer_group_id"  "customer_group_id" integer NULL DEFAULT NULL;