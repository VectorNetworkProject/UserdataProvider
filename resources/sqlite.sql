-- #! sqlite
-- #{ account
-- #  { init
CREATE TABLE IF NOT EXISTS accounts(
  id   INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL
);
-- #  }
-- #  { register
-- #    :name string
INSERT OR REPLACE INTO accounts(
  name
) VALUES (
  :name
);
-- #  }
-- #}
-- #{ ffapvp
-- #  { init
CREATE TABLE IF NOT EXISTS ffapvp(
  id INTEGER NOT NULL,
  kill INTEGER NOT NULL DEFAULT 0,
  death INTEGER NOT NULL DEFAULT 0,
  exp INTEGER NOT NULL DEFAULT 0,
  level INTEGER NOT NULL DEFAULT 0
);
-- #  }
-- #  { register
-- #    :id int
INSERT OR REPLACE INTO ffapvp(
  id
) VALUES (
  :id
);
-- #  }
-- #}