-- -----------------------------------------------------
-- Table "#__sr_categories"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_categories";
CREATE TABLE "#__sr_categories" (
  "id" serial NOT NULL,
  "parent_id" integer NOT NULL DEFAULT 0,
  "asset_id" integer NOT NULL DEFAULT 0,
  "lft" integer NOT NULL DEFAULT 0,
  "rgt" integer NOT NULL DEFAULT 0,
  "title" character varying(255) NOT NULL,
  "alias" character varying(255) NOT NULL,
  "description" text DEFAULT '' NOT NULL,
  "state" smallint NOT NULL DEFAULT 0,
  "ordering" integer NOT NULL DEFAULT 0,
  "access" integer NOT NULL DEFAULT 1,
  "checked_out" integer NOT NULL DEFAULT 0,
  "checked_out_time" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "created_by" integer NOT NULL DEFAULT 0,
  "created_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "modified_by" integer NOT NULL DEFAULT 0,
  "modified_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "params" text NOT NULL,
  PRIMARY KEY ("id")
);


-- -----------------------------------------------------
-- Table "#__sr_countries"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_countries";
CREATE TABLE "#__sr_countries" (
  "id" serial NOT NULL,
  "name" character varying(45) NOT NULL,
  "code_2" character varying(10) NOT NULL,
  "code_3" character varying(10) NOT NULL,
  "state" smallint NOT NULL DEFAULT 0,
  "checked_out" integer NOT NULL DEFAULT 0,
  "checked_out_time" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "created_by" integer NOT NULL DEFAULT 0,
  "created_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "modified_by" integer NOT NULL DEFAULT 0,
  "modified_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY ("id")
);


-- -----------------------------------------------------
-- Table "#__sr_geo_states"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_geo_states";
CREATE TABLE "#__sr_geo_states" (
  "id" serial NOT NULL,
  "country_id" integer NOT NULL DEFAULT 0,
  "name" character varying(45) NOT NULL,
  "code_2" character varying(10) NOT NULL,
  "code_3" character varying(10) NOT NULL,
  "state" smallint NOT NULL DEFAULT 0,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sr_geo_states_sr_countries1" FOREIGN KEY ("country_id") REFERENCES "#__sr_countries" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_geo_states_sr_countries1_idx" ON "#__sr_geo_states" ("country_id" ASC);


-- -----------------------------------------------------
-- Table "#__sr_customer_groups"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_customer_groups";
CREATE TABLE "#__sr_customer_groups" (
  "id" serial NOT NULL,
  "name" character varying(255) NOT NULL,
  "state" smallint NOT NULL DEFAULT 0,
  PRIMARY KEY ("id")
);


-- -----------------------------------------------------
-- Table "#__sr_customers"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_customers";
CREATE TABLE "#__sr_customers" (
  "id" serial NOT NULL,
  "customer_group_id" integer NULL DEFAULT NULL,
  "user_id" integer NOT NULL,
  "customer_code" character varying(255) DEFAULT NULL,
  "firstname" character varying(255) DEFAULT NULL,
  "middlename" character varying(255) DEFAULT NULL,
  "lastname" character varying(255) DEFAULT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sr_customers_sr_customer_groups1" FOREIGN KEY ("customer_group_id") REFERENCES "#__sr_customer_groups" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_customers_sr_customer_groups1_idx" ON "#__sr_customers" ("customer_group_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_currencies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_currencies";
CREATE TABLE "#__sr_currencies" (
  "id" serial NOT NULL,
  "currency_name" character varying(45) NOT NULL,
  "currency_code" character varying(10) NOT NULL,
  "state" smallint NOT NULL DEFAULT 0,
  "exchange_rate" real NOT NULL DEFAULT 0,
  "sign" character varying(10) NOT NULL,
  PRIMARY KEY ("id")
);


-- -----------------------------------------------------
-- Table "#__sr_reservation_assets"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_reservation_assets";
CREATE TABLE "#__sr_reservation_assets" (
  "id" serial NOT NULL,
  "asset_id" integer NULL DEFAULT NULL,
  "category_id" integer NULL DEFAULT NULL,
  "name" character varying(255) NOT NULL,
  "alias" character varying(255) NOT NULL,
  "address_1" character varying(255) NOT NULL,
  "address_2" character varying(255) NOT NULL,
  "city" character varying(45) NOT NULL,
  "postcode" character varying(45) NOT NULL,
  "phone" character varying(30) NOT NULL,
  "description" text NOT NULL,
  "email" character varying(50) NOT NULL,
  "website" character varying(255) NOT NULL,
  "featured" smallint NOT NULL DEFAULT 0,
  "fax" character varying(45) NOT NULL,
  "rating" smallint NOT NULL DEFAULT 0,
  "geo_state_id" integer DEFAULT NULL,
  "country_id" integer NOT NULL DEFAULT 0,
  "created_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "modified_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "created_by" integer NOT NULL DEFAULT 0,
  "modified_by" integer NOT NULL DEFAULT 0,
  "state" smallint NOT NULL DEFAULT 0,
  "checked_out" integer NOT NULL DEFAULT 0,
  "checked_out_time" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "ordering" integer NOT NULL DEFAULT 0,
  "archived" smallint NOT NULL DEFAULT 0,
  "approved" smallint NOT NULL DEFAULT 0,
  "access" integer NOT NULL DEFAULT 1,
  "params" text NOT NULL,
  "language" character varying(10) NOT NULL,
  "hits" integer NOT NULL DEFAULT 0,
  "metakey" text NOT NULL,
  "metadesc" text NOT NULL,
  "metadata" text NOT NULL,
  "xreference" character varying(50) NOT NULL,
  "partner_id" integer DEFAULT NULL,
  "lat" real,
  "lng" real,
  "default" smallint NOT NULL DEFAULT 0,
  "deposit_required" smallint NULL DEFAULT 0,
  "deposit_is_percentage" smallint NULL DEFAULT 1,
  "deposit_amount" real NULL,
  "currency_id" integer NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sr_reservation_assets_sr_categories1" FOREIGN KEY ("category_id") REFERENCES "#__sr_categories" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_reservation_assets_sr_countries1" FOREIGN KEY ("country_id") REFERENCES "#__sr_countries" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_reservation_assets_sr_geo_states1" FOREIGN KEY ("geo_state_id") REFERENCES "#__sr_geo_states" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_reservation_assets_sr_customers1" FOREIGN KEY ("partner_id") REFERENCES "#__sr_customers" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_reservation_assets_sr_currencies1" FOREIGN KEY ("currency_id") REFERENCES "#__sr_currencies" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_reservation_assets_sr_categories1_idx" ON "#__sr_reservation_assets" ("category_id" ASC);
CREATE INDEX "fk_sr_reservation_assets_sr_countries1_idx" ON "#__sr_reservation_assets" ("country_id" ASC);
CREATE INDEX "fk_sr_reservation_assets_sr_geo_states1_idx" ON "#__sr_reservation_assets" ("geo_state_id" ASC);
CREATE INDEX "fk_sr_reservation_assets_sr_customers1_idx" ON "#__sr_reservation_assets" ("partner_id" ASC);
CREATE INDEX "fk_sr_reservation_assets_sr_currencies1_idx" ON "#__sr_reservation_assets" ("currency_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_room_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_room_types";
CREATE TABLE "#__sr_room_types" (
  "id" serial NOT NULL,
  "reservation_asset_id" integer NOT NULL DEFAULT 0,
  "name" character varying(255) NOT NULL,
  "alias" character varying(255) NOT NULL,
  "description" text NOT NULL,
  "state" smallint NOT NULL DEFAULT 0,
  "checked_out" integer NOT NULL DEFAULT 0,
  "checked_out_time" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "created_by" integer NOT NULL DEFAULT 0,
  "created_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "modified_by" integer NOT NULL DEFAULT 0,
  "modified_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "language" character varying(10) NOT NULL,
  "params" text NOT NULL,
  "featured" smallint NOT NULL DEFAULT 0,
  "ordering" integer NOT NULL DEFAULT 0,
  "occupancy_adult" smallint NOT NULL DEFAULT 0,
  "occupancy_child" smallint NOT NULL DEFAULT 0,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sr_room_types_sr_reservation_assets1" FOREIGN KEY ("reservation_asset_id") REFERENCES "#__sr_reservation_assets" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_room_types_sr_reservation_assets1_idx" ON "#__sr_room_types" ("reservation_asset_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_coupons`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_coupons";
CREATE TABLE "#__sr_coupons" (
  "id" serial NOT NULL,
  "state" smallint NOT NULL DEFAULT 0,
  "coupon_name" character varying(255) NOT NULL,
  "coupon_code" character varying(15) NOT NULL,
  "amount" integer NOT NULL,
  "is_percent" smallint NOT NULL DEFAULT 0,
  "valid_from" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "valid_to" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "customer_group_id" integer DEFAULT NULL,
  "reservation_asset_id" integer NOT NULL,
  "valid_from_checkin" timestamp without time zone NULL DEFAULT '1970-01-01 00:00:00',
  "valid_to_checkin" timestamp without time zone NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sr_coupons_sr_customer_groups1" FOREIGN KEY ("customer_group_id") REFERENCES "#__sr_customer_groups" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_coupons_sr_reservation_assets1" FOREIGN KEY ("reservation_asset_id") REFERENCES "#__sr_reservation_assets" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_coupons_sr_customer_groups1_idx" ON "#__sr_coupons" ("customer_group_id" ASC);
CREATE INDEX "fk_sr_coupons_sr_reservation_assets1_idx" ON "#__sr_coupons" ("reservation_asset_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_reservations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_reservations";
CREATE TABLE "#__sr_reservations" (
  "id" serial NOT NULL,
  "state" smallint NOT NULL DEFAULT 0,
  "customer_id" integer DEFAULT NULL,
  "created_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "modified_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "modified_by" integer NOT NULL DEFAULT 0,
  "created_by" integer NOT NULL DEFAULT 0,
  "payment_method_id" integer NOT NULL DEFAULT 0,
  "code" character varying(255) NOT NULL UNIQUE,
  "coupon_id" integer DEFAULT NULL,
  "coupon_code" character varying(15) NULL DEFAULT NULL,
  "customer_firstname" character varying(255) DEFAULT NULL,
  "customer_middlename" character varying(255) DEFAULT NULL,
  "customer_lastname" character varying(255) DEFAULT NULL,
  "customer_email" character varying(255) DEFAULT NULL,
  "customer_phonenumber" character varying(45) NULL DEFAULT NULL,
  "customer_company" character varying(45) NULL DEFAULT NULL,
  "customer_address1" character varying(45) NULL DEFAULT NULL,
  "customer_address2" character varying(45) NULL DEFAULT NULL,
  "customer_city" character varying(45) NULL DEFAULT NULL,
  "customer_zipcode" character varying(45) NULL DEFAULT NULL,
  "customer_country_id" integer NULL DEFAULT NULL,
  "customer_geo_state_id" integer NULL DEFAULT NULL,
  "checkin" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "checkout" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "invoice_number" character varying(255) DEFAULT NULL,
  "currency_id" integer DEFAULT NULL,
  "currency_code" character varying(10) NULL,
  "total_price" decimal DEFAULT NULL,
  "total_price_tax_incl" decimal DEFAULT NULL,
  "total_price_tax_excl" decimal DEFAULT NULL,
  "total_extra_price" decimal DEFAULT NULL,
  "total_extra_price_tax_incl" decimal DEFAULT NULL,
  "total_extra_price_tax_excl" decimal DEFAULT NULL,
  "total_discount" decimal DEFAULT NULL,
  "note" text NULL DEFAULT NULL,
  "reservation_asset_id" integer NULL DEFAULT NULL ,
  "reservation_asset_name" character varying(255) NULL DEFAULT NULL ,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sr_reservations_sr_coupons1" FOREIGN KEY ("coupon_id") REFERENCES "#__sr_coupons" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_reservations_sr_reservation_assets1" FOREIGN KEY ("reservation_asset_id") REFERENCES "#__sr_reservation_assets" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_reservations_sr_coupons1_idx" ON "#__sr_reservations" ("coupon_id" ASC);
CREATE INDEX "fk_sr_reservations_sr_reservation_assets1_idx" ON "#__sr_reservations" ("reservation_asset_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_media`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_media";
CREATE TABLE "#__sr_media" (
  "id" serial NOT NULL,
  "type" character varying(45) NOT NULL,
  "value" text NOT NULL,
  "name" character varying(255) NOT NULL,
  "created_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "modified_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "created_by" integer NOT NULL DEFAULT 0,
  "modified_by" integer NOT NULL DEFAULT 0,
  "mime_type" character varying(255) NOT NULL,
  "size" integer NOT NULL DEFAULT 0,
  PRIMARY KEY ("id")
);


-- -----------------------------------------------------
-- Table `#__sr_extras`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_extras";
CREATE TABLE "#__sr_extras" (
  "id" serial NOT NULL,
  "name" character varying(255) NOT NULL,
  "state" smallint NOT NULL DEFAULT 0,
  "description" text NOT NULL,
  "created_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "modified_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "created_by" integer NOT NULL DEFAULT 0,
  "modified_by" integer NOT NULL DEFAULT 0,
  "price" decimal NOT NULL DEFAULT 0,
  "ordering" integer NOT NULL DEFAULT 0,
  "max_quantity" integer NOT NULL DEFAULT 0,
  "daily_chargable" smallint NOT NULL DEFAULT 0,
  "reservation_asset_id" integer NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sr_extras_sr_reservation_assets1" FOREIGN KEY ("reservation_asset_id") REFERENCES "#__sr_reservation_assets" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_extras_sr_reservation_assets1_idx" ON "#__sr_extras" ("reservation_asset_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_prices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_prices";
CREATE TABLE "#__sr_prices" (
  "id" serial NOT NULL,
  "currency_id" integer NOT NULL DEFAULT 0,
  "customer_group_id" integer NULL DEFAULT NULL,
  "price" decimal NOT NULL,
  "valid_from" timestamp without time zone NOT NULL,
  "valid_to" timestamp without time zone NOT NULL,
  "room_type_id" integer DEFAULT NULL,
  "title" character varying(45) DEFAULT NULL,
  "description" character varying(255) DEFAULT NULL,
  "d_min" smallint DEFAULT NULL,
  "d_max" smallint DEFAULT NULL,
  "p_min" smallint DEFAULT NULL,
  "p_max" smallint DEFAULT NULL,
  "w_day" smallint DEFAULT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sr_prices_sr_currencies1" FOREIGN KEY ("currency_id") REFERENCES "#__sr_currencies" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_prices_sr_room_types1" FOREIGN KEY ("room_type_id") REFERENCES "#__sr_room_types" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_prices_sr_customer_groups1" FOREIGN KEY ("customer_group_id") REFERENCES "#__sr_customer_groups" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_prices_sr_currencies1_idx" ON "#__sr_prices" ("currency_id" ASC);
CREATE INDEX "fk_sr_prices_sr_room_types1_idx" ON "#__sr_prices" ("room_type_id" ASC);
CREATE INDEX "fk_sr_prices_sr_customer_groups1_idx" ON "#__sr_prices" ("customer_group_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_rooms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_rooms";
CREATE TABLE "#__sr_rooms" (
  "id" serial NOT NULL,
  "label" character varying(255) NOT NULL,
  "room_type_id" integer NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sr_rooms_sr_room_types1" FOREIGN KEY ("room_type_id") REFERENCES "#__sr_room_types" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_rooms_sr_room_types1_idx" ON "#__sr_rooms" ("room_type_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_reservation_room_xref`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_reservation_room_xref";
CREATE TABLE "#__sr_reservation_room_xref" (
  "id" serial NOT NULL,
  "reservation_id" integer NOT NULL,
  "room_id" integer DEFAULT NULL,
  "room_label" character varying(255) DEFAULT NULL,
  "adults_number" smallint NOT NULL DEFAULT 0,
  "children_number" smallint NOT NULL DEFAULT 0,
  "guest_fullname" character varying(500) DEFAULT NULL,
  "room_price" DECIMAL NULL DEFAULT NULL ,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_reservations_rooms_xref_reservations1" FOREIGN KEY ("reservation_id") REFERENCES "#__sr_reservations" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_reservation_room_coupon_extra_xref_sr_rooms1" FOREIGN KEY ("room_id") REFERENCES "#__sr_rooms" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_reservations_rooms_xref_reservations1_idx" ON "#__sr_reservation_room_xref" ("reservation_id" ASC);
CREATE INDEX "fk_sr_reservation_room_coupon_extra_xref_sr_rooms1_idx" ON "#__sr_reservation_room_xref" ("room_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_media_reservation_assets_xref`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_media_reservation_assets_xref";
CREATE TABLE "#__sr_media_reservation_assets_xref" (
  "media_id" integer NOT NULL,
  "reservation_asset_id" integer NOT NULL,
  "weight" integer NOT NULL DEFAULT 0,
  PRIMARY KEY ("media_id","reservation_asset_id"),
  CONSTRAINT "fk_sr_media_ref_reservation_assets_sr_media1" FOREIGN KEY ("media_id") REFERENCES "#__sr_media" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_media_ref_reservation_assets_sr_reservation1" FOREIGN KEY ("reservation_asset_id") REFERENCES "#__sr_reservation_assets" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_media_ref_reservation_assets_sr_media1_idx" ON "#__sr_media_reservation_assets_xref" ("media_id" ASC);
CREATE INDEX "fk_sr_media_ref_reservation_assets_sr_reservation1_idx" ON "#__sr_media_reservation_assets_xref" ("reservation_asset_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_media_roomtype_xref`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_media_roomtype_xref";
CREATE TABLE "#__sr_media_roomtype_xref" (
  "media_id" integer NOT NULL,
  "room_type_id" integer NOT NULL,
  "weight" integer NOT NULL DEFAULT 0,
  CONSTRAINT "fk_sr_media_ref_roomtype_sr_media1" FOREIGN KEY ("media_id") REFERENCES "#__sr_media" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_media_ref_roomtype_sr_room_types1" FOREIGN KEY ("room_type_id") REFERENCES "#__sr_room_types" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_media_ref_roomtype_sr_media1_idx" ON "#__sr_media_roomtype_xref" ("media_id" ASC);
CREATE INDEX "fk_sr_media_ref_roomtype_sr_room_types1_idx" ON "#__sr_media_roomtype_xref" ("room_type_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_reservation_asset_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_reservation_asset_fields";
CREATE TABLE "#__sr_reservation_asset_fields" (
  "reservation_asset_id" integer NOT NULL,
  "field_key" character varying(100) NOT NULL,
  "field_value" TEXT DEFAULT NULL,
  "ordering" integer NOT NULL DEFAULT 0,
  PRIMARY KEY ("field_key","reservation_asset_id"),
  CONSTRAINT "fk_sr_reservation_asset_fields_sr_reservation_assets1" FOREIGN KEY ("reservation_asset_id") REFERENCES "#__sr_reservation_assets" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_reservation_asset_fields_sr_reservation_assets1_idx" ON "#__sr_reservation_asset_fields" ("reservation_asset_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_customer_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_customer_fields";
CREATE TABLE "#__sr_customer_fields" (
  "user_id" integer NOT NULL,
  "field_key" character varying(100) NOT NULL,
  "field_value" character varying(255) DEFAULT NULL,
  "ordering" integer NOT NULL DEFAULT 0,
  PRIMARY KEY ("field_key"),
  CONSTRAINT "fk_sr_customer_fields_sr_customers1" FOREIGN KEY ("user_id") REFERENCES "#__sr_customers" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_customer_fields_sr_customers1_idx" ON "#__sr_customer_fields" ("user_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_taxes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_taxes";
CREATE TABLE "#__sr_taxes" (
  "id" serial NOT NULL,
  "name" character varying(255) NOT NULL,
  "rate" real NOT NULL,
  "state" smallint NOT NULL,
  "country_id" integer DEFAULT NULL,
  "geo_state_id" integer DEFAULT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sr_taxes_sr_countries1" FOREIGN KEY ("country_id") REFERENCES "#__sr_countries" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_taxes_sr_geo_states1" FOREIGN KEY ("geo_state_id") REFERENCES "#__sr_geo_states" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_taxes_sr_countries1_idx" ON "#__sr_taxes" ("country_id" ASC);
CREATE INDEX "fk_sr_taxes_sr_geo_states1_idx" ON "#__sr_taxes" ("geo_state_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_room_type_coupon_xref`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_room_type_coupon_xref";
CREATE TABLE "#__sr_room_type_coupon_xref" (
  "room_type_id" integer NOT NULL,
  "coupon_id" integer NOT NULL,
  PRIMARY KEY ("room_type_id","coupon_id"),
  CONSTRAINT "fk_sr_room_type_coupon_xref_sr_coupons1" FOREIGN KEY ("coupon_id") REFERENCES "#__sr_coupons" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_room_type_coupon_xref_sr_room_types1" FOREIGN KEY ("room_type_id") REFERENCES "#__sr_room_types" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_room_type_coupon_xref_sr_coupons1_idx" ON "#__sr_room_type_coupon_xref" ("coupon_id" ASC);
CREATE INDEX "fk_sr_room_type_coupon_xref_sr_room_types1_idx" ON "#__sr_room_type_coupon_xref" ("room_type_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_room_type_extra_xref`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_room_type_extra_xref";
CREATE TABLE "#__sr_room_type_extra_xref" (
  "room_type_id" integer NOT NULL,
  "extra_id" integer NOT NULL,
  PRIMARY KEY ("room_type_id","extra_id"),
  CONSTRAINT "fk_sr_room_type_extra_xref_sr_extras1" FOREIGN KEY ("extra_id") REFERENCES "#__sr_extras" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_room_type_extra_xref_sr_room_types1" FOREIGN KEY ("room_type_id") REFERENCES "#__sr_room_types" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_room_type_extra_xref_sr_extras1_idx" ON "#__sr_room_type_extra_xref" ("extra_id" ASC);
CREATE INDEX "fk_sr_room_type_extra_xref_sr_room_types1_idx" ON "#__sr_room_type_extra_xref" ("room_type_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_reservation_room_extra_xref`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_reservation_room_extra_xref";
CREATE TABLE "#__sr_reservation_room_extra_xref" (
  "id" serial NOT NULL,
  "reservation_id" integer NOT NULL,
  "room_id" integer DEFAULT NULL,
  "room_label" character varying(255) DEFAULT NULL,
  "extra_id" integer DEFAULT NULL,
  "extra_name" character varying(255) DEFAULT NULL,
  "extra_quantity" integer DEFAULT NULL,
  "extra_price" decimal DEFAULT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sr_reservation_room_extra_xref_sr_reservations1" FOREIGN KEY ("reservation_id") REFERENCES "#__sr_reservations" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_reservation_room_extra_xref_sr_rooms1" FOREIGN KEY ("room_id") REFERENCES "#__sr_rooms" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "fk_sr_reservation_room_extra_xref_sr_extras1" FOREIGN KEY ("extra_id") REFERENCES "#__sr_extras" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_reservation_room_extra_xref_sr_reservations1" ON "#__sr_reservation_room_extra_xref" ("reservation_id" ASC);
CREATE INDEX "fk_sr_reservation_room_extra_xref_sr_rooms1" ON "#__sr_reservation_room_extra_xref" ("room_id" ASC);
CREATE INDEX "fk_sr_reservation_room_extra_xref_sr_extras1" ON "#__sr_reservation_room_extra_xref" ("extra_id" ASC);


-- -----------------------------------------------------
-- Table `#__sr_room_type_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "#__sr_room_type_fields";
CREATE TABLE "#__sr_room_type_fields" (
  "room_type_id" integer NOT NULL,
  "field_key" character varying(100) NOT NULL,
  "field_value" TEXT DEFAULT NULL,
  "ordering" integer NOT NULL DEFAULT 0,
  PRIMARY KEY ("room_type_id","field_key"),
  CONSTRAINT "fk_sr_room_type_fields_sr_room_types1" FOREIGN KEY ("room_type_id") REFERENCES "#__sr_room_types" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX "fk_sr_room_type_fields_sr_room_types1_idx" ON "#__sr_room_type_fields" ("room_type_id" ASC);


-- -----------------------------------------------------
-- Table "#__sr_reservation_notes"
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS "#__sr_reservation_notes" (
  "id" serial NOT NULL,
  "reservation_id" integer NULL DEFAULT NULL ,
  "text" TEXT NULL DEFAULT NULL ,
  "created_date" timestamp without time zone NOT NULL DEFAULT '1970-01-01 00:00:00',
  "created_by" integer NULL DEFAULT NULL ,
  "notify_customer" smallint DEFAULT 0 ,
  "visible_in_frontend" smallint NULL DEFAULT 0 ,
  PRIMARY KEY ("id") ,
  CONSTRAINT "fk_jos_sr_reservation_notes_jos_sr_reservations1"
    FOREIGN KEY ("reservation_id" )
    REFERENCES "#__sr_reservations" ("id" )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
CREATE INDEX "fk_jos_sr_reservation_notes_jos_sr_reservations1_idx" ON "#__sr_reservation_notes" ("reservation_id" ASC);

-- -----------------------------------------------------
-- Table "#__sr_config_data"
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS "#__sr_config_data" (
  "id" serial NOT NULL,
  "scope_id" integer NOT NULL DEFAULT 0 ,
  "data_key" character varying(255) NOT NULL ,
  "data_value" TEXT NULL DEFAULT NULL ,
  PRIMARY KEY ("id") );



--
-- Dumping data for table "#__sr_countries"
--
INSERT INTO "#__sr_countries" ("id", "name", "code_2", "code_3", "state", "checked_out", "checked_out_time", "created_by", "created_date", "modified_by", "modified_date") VALUES
(2, 'Afghanistan', 'AF', 'AFG', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(3, 'Albania', 'AL', 'ALB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(4, 'Algeria', 'DZ', 'DZA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(5, 'American Samoa', 'AS', 'ASM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(6, 'Andorra', 'AD', 'AND', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(7, 'Angola', 'AO', 'AGO', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(8, 'Anguilla', 'AI', 'AIA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(9, 'Antarctica', 'AQ', 'ATA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(10, 'Antigua and Barbuda', 'AG', 'ATG', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(11, 'Argentina', 'AR', 'ARG', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(12, 'Armenia', 'AM', 'ARM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(13, 'Aruba', 'AW', 'ABW', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(14, 'Australia', 'AU', 'AUS', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(15, 'Austria', 'AT', 'AUT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(16, 'Azerbaijan', 'AZ', 'AZE', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(17, 'Bahamas', 'BS', 'BHS', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(18, 'Bahrain', 'BH', 'BHR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(19, 'Bangladesh', 'BD', 'BGD', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(20, 'Barbados', 'BB', 'BRB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(21, 'Belarus', 'BY', 'BLR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(22, 'Belgium', 'BE', 'BEL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(23, 'Belize', 'BZ', 'BLZ', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(24, 'Benin', 'BJ', 'BEN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(25, 'Bermuda', 'BM', 'BMU', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(26, 'Bhutan', 'BT', 'BTN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(27, 'Bolivia', 'BO', 'BOL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(28, 'Bosnia and Herzegowina', 'BA', 'BIH', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(29, 'Botswana', 'BW', 'BWA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(30, 'Bouvet Island', 'BV', 'BVT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(31, 'Brazil', 'BR', 'BRA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(32, 'British Indian Ocean Territory', 'IO', 'IOT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(33, 'Brunei Darussalam', 'BN', 'BRN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(34, 'Bulgaria', 'BG', 'BGR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(35, 'Burkina Faso', 'BF', 'BFA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(36, 'Burundi', 'BI', 'BDI', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(37, 'Cambodia', 'KH', 'KHM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(38, 'Cameroon', 'CM', 'CMR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(39, 'Canada', 'CA', 'CAN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(40, 'Cape Verde', 'CV', 'CPV', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(41, 'Cayman Islands', 'KY', 'CYM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(42, 'Central African Republic', 'CF', 'CAF', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(43, 'Chad', 'TD', 'TCD', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(44, 'Chile', 'CL', 'CHL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(45, 'China', 'CN', 'CHN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(46, 'Christmas Island', 'CX', 'CXR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(47, 'Cocos (Keeling) Islands', 'CC', 'CCK', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(48, 'Colombia', 'CO', 'COL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(49, 'Comoros', 'KM', 'COM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(50, 'Congo', 'CG', 'COG', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(51, 'Cook Islands', 'CK', 'COK', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(52, 'Costa Rica', 'CR', 'CRI', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(53, 'Cote D''Ivoire', 'CI', 'CIV', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(54, 'Croatia', 'HR', 'HRV', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(55, 'Cuba', 'CU', 'CUB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(56, 'Cyprus', 'CY', 'CYP', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(57, 'Czech Republic', 'CZ', 'CZE', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(58, 'Denmark', 'DK', 'DNK', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(59, 'Djibouti', 'DJ', 'DJI', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(60, 'Dominica', 'DM', 'DMA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(61, 'Dominican Republic', 'DO', 'DOM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(62, 'East Timor', 'TP', 'TMP', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(63, 'Ecuador', 'EC', 'ECU', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(64, 'Egypt', 'EG', 'EGY', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(65, 'El Salvador', 'SV', 'SLV', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(66, 'Equatorial Guinea', 'GQ', 'GNQ', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(67, 'Eritrea', 'ER', 'ERI', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(68, 'Estonia', 'EE', 'EST', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(69, 'Ethiopia', 'ET', 'ETH', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(70, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(71, 'Faroe Islands', 'FO', 'FRO', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(72, 'Fiji', 'FJ', 'FJI', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(73, 'Finland', 'FI', 'FIN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(74, 'France', 'FR', 'FRA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(75, 'France, Metropolitan', 'FX', 'FXX', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(76, 'French Guiana', 'GF', 'GUF', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(77, 'French Polynesia', 'PF', 'PYF', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(78, 'French Southern Territories', 'TF', 'ATF', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(79, 'Gabon', 'GA', 'GAB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(80, 'Gambia', 'GM', 'GMB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(81, 'Georgia', 'GE', 'GEO', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(82, 'Germany', 'DE', 'DEU', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(83, 'Ghana', 'GH', 'GHA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(84, 'Gibraltar', 'GI', 'GIB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(85, 'Greece', 'GR', 'GRC', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(86, 'Greenland', 'GL', 'GRL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(87, 'Grenada', 'GD', 'GRD', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(88, 'Guadeloupe', 'GP', 'GLP', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(89, 'Guam', 'GU', 'GUM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(90, 'Guatemala', 'GT', 'GTM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(91, 'Guinea', 'GN', 'GIN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(92, 'Guinea-bissau', 'GW', 'GNB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(93, 'Guyana', 'GY', 'GUY', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(94, 'Haiti', 'HT', 'HTI', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(95, 'Heard and Mc Donald Islands', 'HM', 'HMD', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(96, 'Honduras', 'HN', 'HND', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(97, 'Hong Kong', 'HK', 'HKG', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(98, 'Hungary', 'HU', 'HUN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(99, 'Iceland', 'IS', 'ISL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(100, 'India', 'IN', 'IND', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(101, 'Indonesia', 'ID', 'IDN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(102, 'Iran (Islamic Republic of)', 'IR', 'IRN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(103, 'Iraq', 'IQ', 'IRQ', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(104, 'Ireland', 'IE', 'IRL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(105, 'Israel', 'IL', 'ISR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(106, 'Italy', 'IT', 'ITA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(107, 'Jamaica', 'JM', 'JAM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(108, 'Japan', 'JP', 'JPN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(109, 'Jordan', 'JO', 'JOR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(110, 'Kazakhstan', 'KZ', 'KAZ', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(111, 'Kenya', 'KE', 'KEN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(112, 'Kiribati', 'KI', 'KIR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(113, 'Korea, Democratic People''s Republic of', 'KP', 'PRK', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(114, 'Korea, Republic of', 'KR', 'KOR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(115, 'Kuwait', 'KW', 'KWT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(116, 'Kyrgyzstan', 'KG', 'KGZ', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(117, 'Lao People''s Democratic Republic', 'LA', 'LAO', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(118, 'Latvia', 'LV', 'LVA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(119, 'Lebanon', 'LB', 'LBN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(120, 'Lesotho', 'LS', 'LSO', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(121, 'Liberia', 'LR', 'LBR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(122, 'Libyan Arab Jamahiriya', 'LY', 'LBY', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(123, 'Liechtenstein', 'LI', 'LIE', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(124, 'Lithuania', 'LT', 'LTU', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(125, 'Luxembourg', 'LU', 'LUX', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(126, 'Macau', 'MO', 'MAC', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(127, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(128, 'Madagascar', 'MG', 'MDG', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(129, 'Malawi', 'MW', 'MWI', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(130, 'Malaysia', 'MY', 'MYS', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(131, 'Maldives', 'MV', 'MDV', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(132, 'Mali', 'ML', 'MLI', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(133, 'Malta', 'MT', 'MLT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(134, 'Marshall Islands', 'MH', 'MHL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(135, 'Martinique', 'MQ', 'MTQ', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(136, 'Mauritania', 'MR', 'MRT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(137, 'Mauritius', 'MU', 'MUS', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(138, 'Mayotte', 'YT', 'MYT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(139, 'Mexico', 'MX', 'MEX', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(140, 'Micronesia, Federated States of', 'FM', 'FSM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(141, 'Moldova, Republic of', 'MD', 'MDA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(142, 'Monaco', 'MC', 'MCO', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(143, 'Mongolia', 'MN', 'MNG', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(144, 'Montserrat', 'MS', 'MSR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(145, 'Morocco', 'MA', 'MAR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(146, 'Mozambique', 'MZ', 'MOZ', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(147, 'Myanmar', 'MM', 'MMR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(148, 'Namibia', 'NA', 'NAM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(149, 'Nauru', 'NR', 'NRU', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(150, 'Nepal', 'NP', 'NPL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(151, 'Netherlands', 'NL', 'NLD', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(152, 'Netherlands Antilles', 'AN', 'ANT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(153, 'New Caledonia', 'NC', 'NCL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(154, 'New Zealand', 'NZ', 'NZL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(155, 'Nicaragua', 'NI', 'NIC', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(156, 'Niger', 'NE', 'NER', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(157, 'Nigeria', 'NG', 'NGA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(158, 'Niue', 'NU', 'NIU', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(159, 'Norfolk Island', 'NF', 'NFK', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(160, 'Northern Mariana Islands', 'MP', 'MNP', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(161, 'Norway', 'NO', 'NOR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(162, 'Oman', 'OM', 'OMN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(163, 'Pakistan', 'PK', 'PAK', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(164, 'Palau', 'PW', 'PLW', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(165, 'Panama', 'PA', 'PAN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(166, 'Papua New Guinea', 'PG', 'PNG', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(167, 'Paraguay', 'PY', 'PRY', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(168, 'Peru', 'PE', 'PER', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(169, 'Philippines', 'PH', 'PHL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(170, 'Pitcairn', 'PN', 'PCN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(171, 'Poland', 'PL', 'POL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(172, 'Portugal', 'PT', 'PRT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(173, 'Puerto Rico', 'PR', 'PRI', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(174, 'Qatar', 'QA', 'QAT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(175, 'Reunion', 'RE', 'REU', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(176, 'Romania', 'RO', 'ROM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(177, 'Russian Federation', 'RU', 'RUS', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(178, 'Rwanda', 'RW', 'RWA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(179, 'Saint Kitts and Nevis', 'KN', 'KNA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(180, 'Saint Lucia', 'LC', 'LCA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(181, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(182, 'Samoa', 'WS', 'WSM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(183, 'San Marino', 'SM', 'SMR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(184, 'Sao Tome and Principe', 'ST', 'STP', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(185, 'Saudi Arabia', 'SA', 'SAU', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(186, 'Senegal', 'SN', 'SEN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(187, 'Seychelles', 'SC', 'SYC', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(188, 'Sierra Leone', 'SL', 'SLE', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(189, 'Singapore', 'SG', 'SGP', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(190, 'Slovakia (Slovak Republic)', 'SK', 'SVK', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(191, 'Slovenia', 'SI', 'SVN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(192, 'Solomon Islands', 'SB', 'SLB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(193, 'Somalia', 'SO', 'SOM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(194, 'South Africa', 'ZA', 'ZAF', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(195, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(196, 'Spain', 'ES', 'ESP', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(197, 'Sri Lanka', 'LK', 'LKA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(198, 'St. Helena', 'SH', 'SHN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(199, 'St. Pierre and Miquelon', 'PM', 'SPM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(200, 'Sudan', 'SD', 'SDN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(201, 'Suriname', 'SR', 'SUR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(202, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(203, 'Swaziland', 'SZ', 'SWZ', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(204, 'Sweden', 'SE', 'SWE', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(205, 'Switzerland', 'CH', 'CHE', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(206, 'Syrian Arab Republic', 'SY', 'SYR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(207, 'Taiwan', 'TW', 'TWN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(208, 'Tajikistan', 'TJ', 'TJK', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(209, 'Tanzania, United Republic of', 'TZ', 'TZA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(210, 'Thailand', 'TH', 'THA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(211, 'Togo', 'TG', 'TGO', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(212, 'Tokelau', 'TK', 'TKL', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(213, 'Tonga', 'TO', 'TON', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(214, 'Trinidad and Tobago', 'TT', 'TTO', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(215, 'Tunisia', 'TN', 'TUN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(216, 'Turkey', 'TR', 'TUR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(217, 'Turkmenistan', 'TM', 'TKM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(218, 'Turks and Caicos Islands', 'TC', 'TCA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(219, 'Tuvalu', 'TV', 'TUV', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(220, 'Uganda', 'UG', 'UGA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(221, 'Ukraine', 'UA', 'UKR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(222, 'United Arab Emirates', 'AE', 'ARE', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(223, 'United Kingdom', 'GB', 'GBR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(224, 'United States', 'US', 'USA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(225, 'United States Minor Outlying Islands', 'UM', 'UMI', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(226, 'Uruguay', 'UY', 'URY', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(227, 'Uzbekistan', 'UZ', 'UZB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(228, 'Vanuatu', 'VU', 'VUT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(229, 'Vatican City State (Holy See)', 'VA', 'VAT', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(230, 'Venezuela', 'VE', 'VEN', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(231, 'Viet Nam', 'VN', 'VNM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(232, 'Virgin Islands (British)', 'VG', 'VGB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(233, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(234, 'Wallis and Futuna Islands', 'WF', 'WLF', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(235, 'Western Sahara', 'EH', 'ESH', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(236, 'Yemen', 'YE', 'YEM', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(237, 'Serbia', 'RS', 'SRB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(238, 'The Democratic Republic of Congo', 'DC', 'DRC', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(239, 'Zambia', 'ZM', 'ZMB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(240, 'Zimbabwe', 'ZW', 'ZWE', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(241, 'East Timor', 'XE', 'XET', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(242, 'Jersey', 'XJ', 'XJE', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(243, 'St. Barthelemy', 'XB', 'XSB', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(244, 'St. Eustatius', 'XU', 'XSE', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(245, 'Canary Islands', 'XC', 'XCA', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00'),
(246, 'Montenegro', 'ME', 'MNE', 1, 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00', 0, '1970-01-01 00:00:00');


--
-- Dumping data for table "#__sr_geo_states"
--
INSERT INTO "#__sr_geo_states" ("id", "country_id", "name", "code_2", "code_3", "state") VALUES
(2, 224, 'Alabama', 'ALA', 'AL', 1),
(3, 224, 'Alaska', 'ALK', 'AK', 1),
(4, 224, 'Arizona', 'ARZ', 'AZ', 1),
(5, 224, 'Arkansas', 'ARK', 'AR', 1),
(6, 224, 'California', 'CAL', 'CA', 1),
(7, 224, 'Colorado', 'COL', 'CO', 1),
(8, 224, 'Connecticut', 'CCT', 'CT', 1),
(9, 224, 'Delaware', 'DEL', 'DE', 1),
(10, 224, 'District Of Columbia', 'DOC', 'DC', 1),
(11, 224, 'Florida', 'FLO', 'FL', 1),
(12, 224, 'Georgia', 'GEA', 'GA', 1),
(13, 224, 'Hawaii', 'HWI', 'HI', 1),
(14, 224, 'Idaho', 'IDA', 'ID', 1),
(15, 224, 'Illinois', 'ILL', 'IL', 1),
(16, 224, 'Indiana', 'IND', 'IN', 1),
(17, 224, 'Iowa', 'IOA', 'IA', 1),
(18, 224, 'Kansas', 'KAS', 'KS', 1),
(19, 224, 'Kentucky', 'KTY', 'KY', 1),
(20, 224, 'Louisiana', 'LOA', 'LA', 1),
(21, 224, 'Maine', 'MAI', 'ME', 1),
(22, 224, 'Maryland', 'MLD', 'MD', 1),
(23, 224, 'Massachusetts', 'MSA', 'MA', 1),
(24, 224, 'Michigan', 'MIC', 'MI', 1),
(25, 224, 'Minnesota', 'MIN', 'MN', 1),
(26, 224, 'Mississippi', 'MIS', 'MS', 1),
(27, 224, 'Missouri', 'MIO', 'MO', 1),
(28, 224, 'Montana', 'MOT', 'MT', 1),
(29, 224, 'Nebraska', 'NEB', 'NE', 1),
(30, 224, 'Nevada', 'NEV', 'NV', 1),
(31, 224, 'New Hampshire', 'NEH', 'NH', 1),
(32, 224, 'New Jersey', 'NEJ', 'NJ', 1),
(33, 224, 'New Mexico', 'NEM', 'NM', 1),
(34, 224, 'New York', 'NEY', 'NY', 1),
(35, 224, 'North Carolina', 'NOC', 'NC', 1),
(36, 224, 'North Dakota', 'NOD', 'ND', 1),
(37, 224, 'Ohio', 'OHI', 'OH', 1),
(38, 224, 'Oklahoma', 'OKL', 'OK', 1),
(39, 224, 'Oregon', 'ORN', 'OR', 1),
(40, 224, 'Pennsylvania', 'PEA', 'PA', 1),
(41, 224, 'Rhode Island', 'RHI', 'RI', 1),
(42, 224, 'South Carolina', 'SOC', 'SC', 1),
(43, 224, 'South Dakota', 'SOD', 'SD', 1),
(44, 224, 'Tennessee', 'TEN', 'TN', 1),
(45, 224, 'Texas', 'TXS', 'TX', 1),
(46, 224, 'Utah', 'UTA', 'UT', 1),
(47, 224, 'Vermont', 'VMT', 'VT', 1),
(48, 224, 'Virginia', 'VIA', 'VA', 1),
(49, 224, 'Washington', 'WAS', 'WA', 1),
(50, 224, 'West Virginia', 'WEV', 'WV', 1),
(51, 224, 'Wisconsin', 'WIS', 'WI', 1),
(52, 224, 'Wyoming', 'WYO', 'WY', 1),
(53, 39, 'Alberta', 'ALB', 'AB', 1),
(54, 39, 'British Columbia', 'BRC', 'BC', 1),
(55, 39, 'Manitoba', 'MAB', 'MB', 1),
(56, 39, 'New Brunswick', 'NEB', 'NB', 1),
(57, 39, 'Newfoundland and Labrador', 'NFL', 'NL', 1),
(58, 39, 'Northwest Territories', 'NWT', 'NT', 1),
(59, 39, 'Nova Scotia', 'NOS', 'NS', 1),
(60, 39, 'Nunavut', 'NUT', 'NU', 1),
(61, 39, 'Ontario', 'ONT', 'ON', 1),
(62, 39, 'Prince Edward Island', 'PEI', 'PE', 1),
(63, 39, 'Quebec', 'QEC', 'QC', 1),
(64, 39, 'Saskatchewan', 'SAK', 'SK', 1),
(65, 39, 'Yukon', 'YUT', 'YT', 1),
(66, 223, 'England', 'ENG', 'EN', 1),
(67, 223, 'Northern Ireland', 'NOI', 'NI', 1),
(68, 223, 'Scotland', 'SCO', 'SD', 1),
(69, 223, 'Wales', 'WLS', 'WS', 1),
(70, 14, 'Australian Capital Territory', 'ACT', 'AC', 1),
(71, 14, 'New South Wales', 'NSW', 'NS', 1),
(72, 14, 'Northern Territory', 'NOT', 'NT', 1),
(73, 14, 'Queensland', 'QLD', 'QL', 1),
(74, 14, 'South Australia', 'SOA', 'SA', 1),
(75, 14, 'Tasmania', 'TAS', 'TS', 1),
(76, 14, 'Victoria', 'VIC', 'VI', 1),
(77, 14, 'Western Australia', 'WEA', 'WA', 1),
(78, 139, 'Aguascalientes', 'AGS', 'AG', 1),
(79, 139, 'Baja California Norte', 'BCN', 'BN', 1),
(80, 139, 'Baja California Sur', 'BCS', 'BS', 1),
(81, 139, 'Campeche', 'CAM', 'CA', 1),
(82, 139, 'Chiapas', 'CHI', 'CS', 1),
(83, 139, 'Chihuahua', 'CHA', 'CH', 1),
(84, 139, 'Coahuila', 'COA', 'CO', 1),
(85, 139, 'Colima', 'COL', 'CM', 1),
(86, 139, 'Distrito Federal', 'DFM', 'DF', 1),
(87, 139, 'Durango', 'DGO', 'DO', 1),
(88, 139, 'Guanajuato', 'GTO', 'GO', 1),
(89, 139, 'Guerrero', 'GRO', 'GU', 1),
(90, 139, 'Hidalgo', 'HGO', 'HI', 1),
(91, 139, 'Jalisco', 'JAL', 'JA', 1),
(92, 139, 'M?xico (Estado de)', 'EDM', 'EM', 1),
(93, 139, 'Michoac?n', 'MCN', 'MI', 1),
(94, 139, 'Morelos', 'MOR', 'MO', 1),
(95, 139, 'Nayarit', 'NAY', 'NY', 1),
(96, 139, 'Nuevo Le?n', 'NUL', 'NL', 1),
(97, 139, 'Oaxaca', 'OAX', 'OA', 1),
(98, 139, 'Puebla', 'PUE', 'PU', 1),
(99, 139, 'Quer?taro', 'QRO', 'QU', 1),
(100, 139, 'Quintana Roo', 'QUR', 'QR', 1),
(101, 139, 'San Luis Potos?', 'SLP', 'SP', 1),
(102, 139, 'Sinaloa', 'SIN', 'SI', 1),
(103, 139, 'Sonora', 'SON', 'SO', 1),
(104, 139, 'Tabasco', 'TAB', 'TA', 1),
(105, 139, 'Tamaulipas', 'TAM', 'TM', 1),
(106, 139, 'Tlaxcala', 'TLX', 'TX', 1),
(107, 139, 'Veracruz', 'VER', 'VZ', 1),
(108, 139, 'Yucat?n', 'YUC', 'YU', 1),
(109, 139, 'Zacatecas', 'ZAC', 'ZA', 1),
(110, 31, 'Acre', 'ACR', 'AC', 1),
(111, 31, 'Alagoas', 'ALG', 'AL', 1),
(112, 31, 'Amap?', 'AMP', 'AP', 1),
(113, 31, 'Amazonas', 'AMZ', 'AM', 1),
(114, 31, 'Bah?a', 'BAH', 'BA', 1),
(115, 31, 'Cear?', 'CEA', 'CE', 1),
(116, 31, 'Distrito Federal', 'DFB', 'DF', 1),
(117, 31, 'Espirito Santo', 'ESS', 'ES', 1),
(118, 31, 'Goi?s', 'GOI', 'GO', 1),
(119, 31, 'Maranh?o', 'MAR', 'MA', 1),
(120, 31, 'Mato Grosso', 'MAT', 'MT', 1),
(121, 31, 'Mato Grosso do Sul', 'MGS', 'MS', 1),
(122, 31, 'Minas Gera?s', 'MIG', 'MG', 1),
(123, 31, 'Paran?', 'PAR', 'PR', 1),
(124, 31, 'Para?ba', 'PRB', 'PB', 1),
(125, 31, 'Par?', 'PAB', 'PA', 1),
(126, 31, 'Pernambuco', 'PER', 'PE', 1),
(127, 31, 'Piau?', 'PIA', 'PI', 1),
(128, 31, 'Rio Grande do Norte', 'RGN', 'RN', 1),
(129, 31, 'Rio Grande do Sul', 'RGS', 'RS', 1),
(130, 31, 'Rio de Janeiro', 'RDJ', 'RJ', 1),
(131, 31, 'Rond?nia', 'RON', 'RO', 1),
(132, 31, 'Roraima', 'ROR', 'RR', 1),
(133, 31, 'Santa Catarina', 'SAC', 'SC', 1),
(134, 31, 'Sergipe', 'SER', 'SE', 1),
(135, 31, 'S?o Paulo', 'SAP', 'SP', 1),
(136, 31, 'Tocantins', 'TOC', 'TO', 1),
(137, 45, 'Anhui', 'ANH', '34', 1),
(138, 45, 'Beijing', 'BEI', '11', 1),
(139, 45, 'Chongqing', 'CHO', '50', 1),
(140, 45, 'Fujian', 'FUJ', '35', 1),
(141, 45, 'Gansu', 'GAN', '62', 1),
(142, 45, 'Guangdong', 'GUA', '44', 1),
(143, 45, 'Guangxi Zhuang', 'GUZ', '45', 1),
(144, 45, 'Guizhou', 'GUI', '52', 1),
(145, 45, 'Hainan', 'HAI', '46', 1),
(146, 45, 'Hebei', 'HEB', '13', 1),
(147, 45, 'Heilongjiang', 'HEI', '23', 1),
(148, 45, 'Henan', 'HEN', '41', 1),
(149, 45, 'Hubei', 'HUB', '42', 1),
(150, 45, 'Hunan', 'HUN', '43', 1),
(151, 45, 'Jiangsu', 'JIA', '32', 1),
(152, 45, 'Jiangxi', 'JIX', '36', 1),
(153, 45, 'Jilin', 'JIL', '22', 1),
(154, 45, 'Liaoning', 'LIA', '21', 1),
(155, 45, 'Nei Mongol', 'NML', '15', 1),
(156, 45, 'Ningxia Hui', 'NIH', '64', 1),
(157, 45, 'Qinghai', 'QIN', '63', 1),
(158, 45, 'Shandong', 'SNG', '37', 1),
(159, 45, 'Shanghai', 'SHH', '31', 1),
(160, 45, 'Shaanxi', 'SHX', '61', 1),
(161, 45, 'Sichuan', 'SIC', '51', 1),
(162, 45, 'Tianjin', 'TIA', '12', 1),
(163, 45, 'Xinjiang Uygur', 'XIU', '65', 1),
(164, 45, 'Xizang', 'XIZ', '54', 1),
(165, 45, 'Yunnan', 'YUN', '53', 1),
(166, 45, 'Zhejiang', 'ZHE', '33', 1),
(167, 105, 'Israel', 'ISL', 'IL', 1),
(168, 105, 'Gaza Strip', 'GZS', 'GZ', 1),
(169, 105, 'West Bank', 'WBK', 'WB', 1),
(170, 152, 'St. Maarten', 'STM', 'SM', 1),
(171, 152, 'Bonaire', 'BNR', 'BN', 1),
(172, 152, 'Curacao', 'CUR', 'CR', 1),
(173, 176, 'Alba', 'ABA', 'AB', 1),
(174, 176, 'Arad', 'ARD', 'AR', 1),
(175, 176, 'Arges', 'ARG', 'AG', 1),
(176, 176, 'Bacau', 'BAC', 'BC', 1),
(177, 176, 'Bihor', 'BIH', 'BH', 1),
(178, 176, 'Bistrita-Nasaud', 'BIS', 'BN', 1),
(179, 176, 'Botosani', 'BOT', 'BT', 1),
(180, 176, 'Braila', 'BRL', 'BR', 1),
(181, 176, 'Brasov', 'BRA', 'BV', 1),
(182, 176, 'Bucuresti', 'BUC', 'B', 1),
(183, 176, 'Buzau', 'BUZ', 'BZ', 1),
(184, 176, 'Calarasi', 'CAL', 'CL', 1),
(185, 176, 'Caras Severin', 'CRS', 'CS', 1),
(186, 176, 'Cluj', 'CLJ', 'CJ', 1),
(187, 176, 'Constanta', 'CST', 'CT', 1),
(188, 176, 'Covasna', 'COV', 'CV', 1),
(189, 176, 'Dambovita', 'DAM', 'DB', 1),
(190, 176, 'Dolj', 'DLJ', 'DJ', 1),
(191, 176, 'Galati', 'GAL', 'GL', 1),
(192, 176, 'Giurgiu', 'GIU', 'GR', 1),
(193, 176, 'Gorj', 'GOR', 'GJ', 1),
(194, 176, 'Hargita', 'HRG', 'HR', 1),
(195, 176, 'Hunedoara', 'HUN', 'HD', 1),
(196, 176, 'Ialomita', 'IAL', 'IL', 1),
(197, 176, 'Iasi', 'IAS', 'IS', 1),
(198, 176, 'Ilfov', 'ILF', 'IF', 1),
(199, 176, 'Maramures', 'MAR', 'MM', 1),
(200, 176, 'Mehedinti', 'MEH', 'MH', 1),
(201, 176, 'Mures', 'MUR', 'MS', 1),
(202, 176, 'Neamt', 'NEM', 'NT', 1),
(203, 176, 'Olt', 'OLT', 'OT', 1),
(204, 176, 'Prahova', 'PRA', 'PH', 1),
(205, 176, 'Salaj', 'SAL', 'SJ', 1),
(206, 176, 'Satu Mare', 'SAT', 'SM', 1),
(207, 176, 'Sibiu', 'SIB', 'SB', 1),
(208, 176, 'Suceava', 'SUC', 'SV', 1),
(209, 176, 'Teleorman', 'TEL', 'TR', 1),
(210, 176, 'Timis', 'TIM', 'TM', 1),
(211, 176, 'Tulcea', 'TUL', 'TL', 1),
(212, 176, 'Valcea', 'VAL', 'VL', 1),
(213, 176, 'Vaslui', 'VAS', 'VS', 1),
(214, 176, 'Vrancea', 'VRA', 'VN', 1),
(215, 106, 'Agrigento', 'AGR', 'AG', 1),
(216, 106, 'Alessandria', 'ALE', 'AL', 1),
(217, 106, 'Ancona', 'ANC', 'AN', 1),
(218, 106, 'Aosta', 'AOS', 'AO', 1),
(219, 106, 'Arezzo', 'ARE', 'AR', 1),
(220, 106, 'Ascoli Piceno', 'API', 'AP', 1),
(221, 106, 'Asti', 'AST', 'AT', 1),
(222, 106, 'Avellino', 'AVE', 'AV', 1),
(223, 106, 'Bari', 'BAR', 'BA', 1),
(224, 106, 'Belluno', 'BEL', 'BL', 1),
(225, 106, 'Benevento', 'BEN', 'BN', 1),
(226, 106, 'Bergamo', 'BEG', 'BG', 1),
(227, 106, 'Biella', 'BIE', 'BI', 1),
(228, 106, 'Bologna', 'BOL', 'BO', 1),
(229, 106, 'Bolzano', 'BOZ', 'BZ', 1),
(230, 106, 'Brescia', 'BRE', 'BS', 1),
(231, 106, 'Brindisi', 'BRI', 'BR', 1),
(232, 106, 'Cagliari', 'CAG', 'CA', 1),
(233, 106, 'Caltanissetta', 'CAL', 'CL', 1),
(234, 106, 'Campobasso', 'CBO', 'CB', 1),
(235, 106, 'Carbonia-Iglesias', 'CAR', 'CI', 1),
(236, 106, 'Caserta', 'CAS', 'CE', 1),
(237, 106, 'Catania', 'CAT', 'CT', 1),
(238, 106, 'Catanzaro', 'CTZ', 'CZ', 1),
(239, 106, 'Chieti', 'CHI', 'CH', 1),
(240, 106, 'Como', 'COM', 'CO', 1),
(241, 106, 'Cosenza', 'COS', 'CS', 1),
(242, 106, 'Cremona', 'CRE', 'CR', 1),
(243, 106, 'Crotone', 'CRO', 'KR', 1),
(244, 106, 'Cuneo', 'CUN', 'CN', 1),
(245, 106, 'Enna', 'ENN', 'EN', 1),
(246, 106, 'Ferrara', 'FER', 'FE', 1),
(247, 106, 'Firenze', 'FIR', 'FI', 1),
(248, 106, 'Foggia', 'FOG', 'FG', 1),
(249, 106, 'Forli-Cesena', 'FOC', 'FC', 1),
(250, 106, 'Frosinone', 'FRO', 'FR', 1),
(251, 106, 'Genova', 'GEN', 'GE', 1),
(252, 106, 'Gorizia', 'GOR', 'GO', 1),
(253, 106, 'Grosseto', 'GRO', 'GR', 1),
(254, 106, 'Imperia', 'IMP', 'IM', 1),
(255, 106, 'Isernia', 'ISE', 'IS', 1),
(256, 106, 'L''Aquila', 'AQU', 'AQ', 1),
(257, 106, 'La Spezia', 'LAS', 'SP', 1),
(258, 106, 'Latina', 'LAT', 'LT', 1),
(259, 106, 'Lecce', 'LEC', 'LE', 1),
(260, 106, 'Lecco', 'LCC', 'LC', 1),
(261, 106, 'Livorno', 'LIV', 'LI', 1),
(262, 106, 'Lodi', 'LOD', 'LO', 1),
(263, 106, 'Lucca', 'LUC', 'LU', 1),
(264, 106, 'Macerata', 'MAC', 'MC', 1),
(265, 106, 'Mantova', 'MAN', 'MN', 1),
(266, 106, 'Massa-Carrara', 'MAS', 'MS', 1),
(267, 106, 'Matera', 'MAA', 'MT', 1),
(268, 106, 'Medio Campidano', 'MED', 'VS', 1),
(269, 106, 'Messina', 'MES', 'ME', 1),
(270, 106, 'Milano', 'MIL', 'MI', 1),
(271, 106, 'Modena', 'MOD', 'MO', 1),
(272, 106, 'Napoli', 'NAP', 'NA', 1),
(273, 106, 'Novara', 'NOV', 'NO', 1),
(274, 106, 'Nuoro', 'NUR', 'NU', 1),
(275, 106, 'Ogliastra', 'OGL', 'OG', 1),
(276, 106, 'Olbia-Tempio', 'OLB', 'OT', 1),
(277, 106, 'Oristano', 'ORI', 'OR', 1),
(278, 106, 'Padova', 'PDA', 'PD', 1),
(279, 106, 'Palermo', 'PAL', 'PA', 1),
(280, 106, 'Parma', 'PAA', 'PR', 1),
(281, 106, 'Pavia', 'PAV', 'PV', 1),
(282, 106, 'Perugia', 'PER', 'PG', 1),
(283, 106, 'Pesaro e Urbino', 'PES', 'PU', 1),
(284, 106, 'Pescara', 'PSC', 'PE', 1),
(285, 106, 'Piacenza', 'PIA', 'PC', 1),
(286, 106, 'Pisa', 'PIS', 'PI', 1),
(287, 106, 'Pistoia', 'PIT', 'PT', 1),
(288, 106, 'Pordenone', 'POR', 'PN', 1),
(289, 106, 'Potenza', 'PTZ', 'PZ', 1),
(290, 106, 'Prato', 'PRA', 'PO', 1),
(291, 106, 'Ragusa', 'RAG', 'RG', 1),
(292, 106, 'Ravenna', 'RAV', 'RA', 1),
(293, 106, 'Reggio Calabria', 'REG', 'RC', 1),
(294, 106, 'Reggio Emilia', 'REE', 'RE', 1),
(295, 106, 'Rieti', 'RIE', 'RI', 1),
(296, 106, 'Rimini', 'RIM', 'RN', 1),
(297, 106, 'Roma', 'ROM', 'RM', 1),
(298, 106, 'Rovigo', 'ROV', 'RO', 1),
(299, 106, 'Salerno', 'SAL', 'SA', 1),
(300, 106, 'Sassari', 'SAS', 'SS', 1),
(301, 106, 'Savona', 'SAV', 'SV', 1),
(302, 106, 'Siena', 'SIE', 'SI', 1),
(303, 106, 'Siracusa', 'SIR', 'SR', 1),
(304, 106, 'Sondrio', 'SOO', 'SO', 1),
(305, 106, 'Taranto', 'TAR', 'TA', 1),
(306, 106, 'Teramo', 'TER', 'TE', 1),
(307, 106, 'Terni', 'TRN', 'TR', 1),
(308, 106, 'Torino', 'TOR', 'TO', 1),
(309, 106, 'Trapani', 'TRA', 'TP', 1),
(310, 106, 'Trento', 'TRE', 'TN', 1),
(311, 106, 'Treviso', 'TRV', 'TV', 1),
(312, 106, 'Trieste', 'TRI', 'TS', 1),
(313, 106, 'Udine', 'UDI', 'UD', 1),
(314, 106, 'Varese', 'VAR', 'VA', 1),
(315, 106, 'Venezia', 'VEN', 'VE', 1),
(316, 106, 'Verbano Cusio Ossola', 'VCO', 'VB', 1),
(317, 106, 'Vercelli', 'VER', 'VC', 1),
(318, 106, 'Verona', 'VRN', 'VR', 1),
(319, 106, 'Vibo Valenzia', 'VIV', 'VV', 1),
(320, 106, 'Vicenza', 'VII', 'VI', 1),
(321, 106, 'Viterbo', 'VIT', 'VT', 1),
(322, 196, 'A Coru?a', 'ACO', '15', 1),
(323, 196, 'Alava', 'ALA', '01', 1),
(324, 196, 'Albacete', 'ALB', '02', 1),
(325, 196, 'Alicante', 'ALI', '03', 1),
(326, 196, 'Almeria', 'ALM', '04', 1),
(327, 196, 'Asturias', 'AST', '33', 1),
(328, 196, 'Avila', 'AVI', '05', 1),
(329, 196, 'Badajoz', 'BAD', '06', 1),
(330, 196, 'Baleares', 'BAL', '07', 1),
(331, 196, 'Barcelona', 'BAR', '08', 1),
(332, 196, 'Burgos', 'BUR', '09', 1),
(333, 196, 'Caceres', 'CAC', '10', 1),
(334, 196, 'Cadiz', 'CAD', '11', 1),
(335, 196, 'Cantabria', 'CAN', '39', 1),
(336, 196, 'Castellon', 'CAS', '12', 1),
(337, 196, 'Ceuta', 'CEU', '51', 1),
(338, 196, 'Ciudad Real', 'CIU', '13', 1),
(339, 196, 'Cordoba', 'COR', '14', 1),
(340, 196, 'Cuenca', 'CUE', '16', 1),
(341, 196, 'Girona', 'GIR', '17', 1),
(342, 196, 'Granada', 'GRA', '18', 1),
(343, 196, 'Guadalajara', 'GUA', '19', 1),
(344, 196, 'Guipuzcoa', 'GUI', '20', 1),
(345, 196, 'Huelva', 'HUL', '21', 1),
(346, 196, 'Huesca', 'HUS', '22', 1),
(347, 196, 'Jaen', 'JAE', '23', 1),
(348, 196, 'La Rioja', 'LRI', '26', 1),
(349, 196, 'Las Palmas', 'LPA', '35', 1),
(350, 196, 'Leon', 'LEO', '24', 1),
(351, 196, 'Lleida', 'LLE', '25', 1),
(352, 196, 'Lugo', 'LUG', '27', 1),
(353, 196, 'Madrid', 'MAD', '28', 1),
(354, 196, 'Malaga', 'MAL', '29', 1),
(355, 196, 'Melilla', 'MEL', '52', 1),
(356, 196, 'Murcia', 'MUR', '30', 1),
(357, 196, 'Navarra', 'NAV', '31', 1),
(358, 196, 'Ourense', 'OUR', '32', 1),
(359, 196, 'Palencia', 'PAL', '34', 1),
(360, 196, 'Pontevedra', 'PON', '36', 1),
(361, 196, 'Salamanca', 'SAL', '37', 1),
(362, 196, 'Santa Cruz de Tenerife', 'SCT', '38', 1),
(363, 196, 'Segovia', 'SEG', '40', 1),
(364, 196, 'Sevilla', 'SEV', '41', 1),
(365, 196, 'Soria', 'SOR', '42', 1),
(366, 196, 'Tarragona', 'TAR', '43', 1),
(367, 196, 'Teruel', 'TER', '44', 1),
(368, 196, 'Toledo', 'TOL', '45', 1),
(369, 196, 'Valencia', 'VAL', '46', 1),
(370, 196, 'Valladolid', 'VLL', '47', 1),
(371, 196, 'Vizcaya', 'VIZ', '48', 1),
(372, 196, 'Zamora', 'ZAM', '49', 1),
(373, 196, 'Zaragoza', 'ZAR', '50', 1),
(374, 12, 'Aragatsotn', 'ARG', 'AG', 1),
(375, 12, 'Ararat', 'ARR', 'AR', 1),
(376, 12, 'Armavir', 'ARM', 'AV', 1),
(377, 12, 'Gegharkunik', 'GEG', 'GR', 1),
(378, 12, 'Kotayk', 'KOT', 'KT', 1),
(379, 12, 'Lori', 'LOR', 'LO', 1),
(380, 12, 'Shirak', 'SHI', 'SH', 1),
(381, 12, 'Syunik', 'SYU', 'SU', 1),
(382, 12, 'Tavush', 'TAV', 'TV', 1),
(383, 12, 'Vayots-Dzor', 'VAD', 'VD', 1),
(384, 12, 'Yerevan', 'YER', 'ER', 1),
(385, 100, 'Andaman & Nicobar Islands', 'ANI', 'AI', 1),
(386, 100, 'Andhra Pradesh', 'AND', 'AN', 1),
(387, 100, 'Arunachal Pradesh', 'ARU', 'AR', 1),
(388, 100, 'Assam', 'ASS', 'AS', 1),
(389, 100, 'Bihar', 'BIH', 'BI', 1),
(390, 100, 'Chandigarh', 'CHA', 'CA', 1),
(391, 100, 'Chhatisgarh', 'CHH', 'CH', 1),
(392, 100, 'Dadra & Nagar Haveli', 'DAD', 'DD', 1),
(393, 100, 'Daman & Diu', 'DAM', 'DA', 1),
(394, 100, 'Delhi', 'DEL', 'DE', 1),
(395, 100, 'Goa', 'GOA', 'GO', 1),
(396, 100, 'Gujarat', 'GUJ', 'GU', 1),
(397, 100, 'Haryana', 'HAR', 'HA', 1),
(398, 100, 'Himachal Pradesh', 'HIM', 'HI', 1),
(399, 100, 'Jammu & Kashmir', 'JAM', 'JA', 1),
(400, 100, 'Jharkhand', 'JHA', 'JH', 1),
(401, 100, 'Karnataka', 'KAR', 'KA', 1),
(402, 100, 'Kerala', 'KER', 'KE', 1),
(403, 100, 'Lakshadweep', 'LAK', 'LA', 1),
(404, 100, 'Madhya Pradesh', 'MAD', 'MD', 1),
(405, 100, 'Maharashtra', 'MAH', 'MH', 1),
(406, 100, 'Manipur', 'MAN', 'MN', 1),
(407, 100, 'Meghalaya', 'MEG', 'ME', 1),
(408, 100, 'Mizoram', 'MIZ', 'MI', 1),
(409, 100, 'Nagaland', 'NAG', 'NA', 1),
(410, 100, 'Orissa', 'ORI', 'OR', 1),
(411, 100, 'Pondicherry', 'PON', 'PO', 1),
(412, 100, 'Punjab', 'PUN', 'PU', 1),
(413, 100, 'Rajasthan', 'RAJ', 'RA', 1),
(414, 100, 'Sikkim', 'SIK', 'SI', 1),
(415, 100, 'Tamil Nadu', 'TAM', 'TA', 1),
(416, 100, 'Tripura', 'TRI', 'TR', 1),
(417, 100, 'Uttaranchal', 'UAR', 'UA', 1),
(418, 100, 'Uttar Pradesh', 'UTT', 'UT', 1),
(419, 100, 'West Bengal', 'WES', 'WE', 1),
(420, 102, 'Ahmadi va Kohkiluyeh', 'BOK', 'BO', 1),
(421, 102, 'Ardabil', 'ARD', 'AR', 1),
(422, 102, 'Azarbayjan-e Gharbi', 'AZG', 'AG', 1),
(423, 102, 'Azarbayjan-e Sharqi', 'AZS', 'AS', 1),
(424, 102, 'Bushehr', 'BUS', 'BU', 1),
(425, 102, 'Chaharmahal va Bakhtiari', 'CMB', 'CM', 1),
(426, 102, 'Esfahan', 'ESF', 'ES', 1),
(427, 102, 'Fars', 'FAR', 'FA', 1),
(428, 102, 'Gilan', 'GIL', 'GI', 1),
(429, 102, 'Gorgan', 'GOR', 'GO', 1),
(430, 102, 'Hamadan', 'HAM', 'HA', 1),
(431, 102, 'Hormozgan', 'HOR', 'HO', 1),
(432, 102, 'Ilam', 'ILA', 'IL', 1),
(433, 102, 'Kerman', 'KER', 'KE', 1),
(434, 102, 'Kermanshah', 'BAK', 'BA', 1),
(435, 102, 'Khorasan-e Junoubi', 'KHJ', 'KJ', 1),
(436, 102, 'Khorasan-e Razavi', 'KHR', 'KR', 1),
(437, 102, 'Khorasan-e Shomali', 'KHS', 'KS', 1),
(438, 102, 'Khuzestan', 'KHU', 'KH', 1),
(439, 102, 'Kordestan', 'KOR', 'KO', 1),
(440, 102, 'Lorestan', 'LOR', 'LO', 1),
(441, 102, 'Markazi', 'MAR', 'MR', 1),
(442, 102, 'Mazandaran', 'MAZ', 'MZ', 1),
(443, 102, 'Qazvin', 'QAS', 'QA', 1),
(444, 102, 'Qom', 'QOM', 'QO', 1),
(445, 102, 'Semnan', 'SEM', 'SE', 1),
(446, 102, 'Sistan va Baluchestan', 'SBA', 'SB', 1),
(447, 102, 'Tehran', 'TEH', 'TE', 1),
(448, 102, 'Yazd', 'YAZ', 'YA', 1),
(449, 102, 'Zanjan', 'ZAN', 'ZA', 1);
