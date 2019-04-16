-- Adminer 4.7.1 PostgreSQL dump

\connect "warehouse";

DROP TABLE IF EXISTS "item";
CREATE TABLE "public"."item" (
    "id" integer NOT NULL,
    "name" text NOT NULL,
    "quantity" integer NOT NULL,
    "price" double precision NOT NULL,
    "date_added" timestamp(0),
    CONSTRAINT "item_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "item" ("id", "name", "quantity", "price", "date_added") VALUES
(2,	'testItem',	1,	12.22,	'2019-04-16 19:10:49'),
(5,	'testItem',	1,	12.22,	'2019-04-16 19:11:01'),
(6,	'testItem',	1,	12.22,	'2019-04-16 19:11:03'),
(7,	'testItem',	1,	12.22,	'2019-04-16 19:11:04'),
(8,	'testItem',	1,	12.22,	'2019-04-16 19:11:05'),
(9,	'testItem',	1,	12.22,	'2019-04-16 19:11:06'),
(10,	'testItem',	1,	12.22,	'2019-04-16 19:11:07'),
(3,	'testItem',	6,	12.22,	'2019-04-16 19:10:53'),
(4,	'testItem',	16,	12.22,	'2019-04-16 19:10:56'),
(1,	'testItem',	2,	12.22,	'2019-04-16 19:10:46');

DROP TABLE IF EXISTS "movement";
CREATE TABLE "public"."movement" (
    "id" integer NOT NULL,
    "item_id" integer NOT NULL,
    "supplier_id" integer,
    "direction" integer NOT NULL,
    "date_when" timestamp(0) NOT NULL,
    CONSTRAINT "movement_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "fk_f4dd95f7126f525e" FOREIGN KEY (item_id) REFERENCES item(id) NOT DEFERRABLE,
    CONSTRAINT "fk_f4dd95f72add6d8c" FOREIGN KEY (supplier_id) REFERENCES supplier(id) NOT DEFERRABLE
) WITH (oids = false);

CREATE INDEX "idx_f4dd95f7126f525e" ON "public"."movement" USING btree ("item_id");

CREATE INDEX "idx_f4dd95f72add6d8c" ON "public"."movement" USING btree ("supplier_id");

INSERT INTO "movement" ("id", "item_id", "supplier_id", "direction", "date_when") VALUES
(1,	1,	1,	1,	'2019-04-16 19:11:51'),
(2,	3,	1,	1,	'2019-04-16 19:11:54'),
(3,	4,	5,	1,	'2019-04-16 19:11:59'),
(4,	1,	8,	1,	'2019-04-16 19:12:05'),
(5,	1,	8,	1,	'2019-04-16 19:12:08'),
(6,	1,	8,	2,	'2019-04-16 19:12:14'),
(7,	1,	8,	2,	'2019-04-16 19:12:16'),
(8,	1,	8,	2,	'2019-04-16 19:12:17'),
(9,	1,	8,	1,	'2019-04-16 19:12:30'),
(10,	1,	8,	1,	'2019-04-16 19:12:32');

DROP TABLE IF EXISTS "supplier";
CREATE TABLE "public"."supplier" (
    "id" integer NOT NULL,
    "name" text NOT NULL,
    "date_registration" timestamp(0) NOT NULL,
    "date_supply" timestamp(0),
    CONSTRAINT "supplier_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "supplier" ("id", "name", "date_registration", "date_supply") VALUES
(1,	'testSupplier',	'2019-04-16 19:11:26',	'2019-04-16 00:00:00'),
(2,	'testSupplier',	'2019-04-16 19:11:27',	'2019-04-16 00:00:00'),
(3,	'testSupplier',	'2019-04-16 19:11:28',	'2019-04-16 00:00:00'),
(4,	'testSupplier',	'2019-04-16 19:11:29',	'2019-04-16 00:00:00'),
(5,	'testSupplier',	'2019-04-16 19:11:30',	'2019-04-16 00:00:00'),
(6,	'testSupplier',	'2019-04-16 19:11:31',	'2019-04-16 00:00:00'),
(7,	'testSupplier',	'2019-04-16 19:11:32',	'2019-04-16 00:00:00'),
(8,	'testSupplier',	'2019-04-16 19:11:33',	'2019-04-16 00:00:00'),
(9,	'testSupplier',	'2019-04-16 19:11:35',	'2019-04-16 00:00:00'),
(10,	'testSupplier',	'2019-04-16 19:11:35',	'2019-04-16 00:00:00');

-- 2019-04-16 17:13:21.896651+00
