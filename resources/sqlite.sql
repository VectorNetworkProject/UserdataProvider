-- #!sqlite
-- #{userdataprovider
-- #  { accounts
-- #    { init
CREATE TABLE IF NOT EXISTS accounts(
  id   INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL
);
-- #    }
-- #    { register
-- #      :name string
INSERT INTO accounts(
  name
) VALUES (
  :name
);
-- #    }
-- #    { unregister
-- #      :id int
DELETE FROM accounts
WHERE id = :id;
-- #    }
-- #  }
--FFAPvP
-- #  { ffapvp
-- #    { init
CREATE TABLE IF NOT EXISTS ffapvp(
  id INTEGER NOT NULL,
  kill INTEGER NOT NULL DEFAULT 0,
  death INTEGER NOT NULL DEFAULT 0,
  exp INTEGER NOT NULL DEFAULT 0
);
-- #    }
-- #    { register
-- #      :id int
INSERT INTO ffapvp(
  id
) VALUES (
  :id
);
-- #    }
-- #    { unregister
-- #      :id int
DELETE FROM ffapvp
WHERE id = :id;
-- #    }
-- #    { addCount
-- #      :kill int
-- #      :death int
-- #      :exp int
UPDATE ffapvp
SET kill = kill + :kill,
    death = death + :death,
    exp = exp + :exp;
-- #    }
-- #    { getRankingByExp
-- #      :limit int
SELECT accounts.name, accounts.id, ffapvp.kill, ffapvp.death, ffapvp.exp
FROM ffapvp
INNER JOIN accounts
ON ffapvp.id = accounts.id
LIMIT :limit
ORDER BY exp DESC;
-- #    }
-- #    { getRankingByKill
-- #      :limit int
SELECT accounts.name, accounts.id, ffapvp.kill, ffapvp.death, ffapvp.exp
FROM ffapvp
INNER JOIN accounts
ON ffapvp.id = accounts.id
limit :limit
ORDER BY kill ASC
-- #    }
-- #  }
-- #}