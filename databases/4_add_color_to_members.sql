-- UP
ALTER TABLE members
    ADD COLUMN color VARCHAR(255) DEFAULT "#ffffff";
-- DOWN
ALTER TABLE members
    DROP COLUMN color;