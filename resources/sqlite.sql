-- #!sqlite
-- #{ userdataprovider
-- #  { accounts
-- #    { init
CREATE TABLE IF NOT EXISTS accounts(
  id   INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT PRIMARY KEY
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
-- #      :name string
DELETE FROM accounts
WHERE id = :name;
-- #    }
-- #  }
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
-- #      :name string
INSERT INTO ffapvp(
  id
)
SELECT id
FROM accounts
WHERE name = :name;
-- #    }
-- #    { unregister
-- #      :name string
DELETE FROM ffapvp
WHERE id
IN (
  SELECT accounts.id
  FROM dual
  INNER JOIN accounts
  ON dual.id = accounts.id
  WHERE accounts.name = :name
);
-- #    }
-- #    { addcount
-- #      :name string
-- #      :kill int
-- #      :death int
-- #      :exp int
UPDATE ffapvp
SET kill = kill + :kill,
    death = death + :death,
    exp = exp + :exp
WHERE id IN (
  SELECT ffapvp.id
  FROM ffapvp
  INNER JOIN accounts
  ON(
    accounts.id = ffapvp.id
  )
  WHERE accounts.name = :name
);
-- #    }
-- #    { getrankingbyExp
-- #      :limit int
SELECT accounts.name, accounts.id, ffapvp.kill, ffapvp.death, ffapvp.exp
FROM ffapvp
INNER JOIN accounts
ON ffapvp.id = accounts.id
LIMIT :limit
ORDER BY exp DESC;
-- #    }
-- #    { getrankingbykill
-- #      :limit int
SELECT accounts.name, accounts.id, ffapvp.kill, ffapvp.death, ffapvp.exp
FROM ffapvp
INNER JOIN accounts
ON ffapvp.id = accounts.id
limit :limit
ORDER BY kill DESC;
-- #    }
-- #  }
-- #  { duel
-- #    { init
CREATE TABLE IF NOT EXISTS dual(
  id INTEGER NOT NULL,
  kill INTEGER NOT NULL DEFAULT 0,
  death INTEGER NOT NULL DEFAULT 0,
  win INTEGER NOT NULL DEFAULT 0,
  lose INTEGER NOT NULL DEFAULT 0
);
-- #    }
-- #    { register
-- #      :name string
INSERT INTO dual(
  id
)
SELECT id
FROM accounts
WHERE name = :name;
-- #    }
-- #    { unregister
-- #      :name string
DELETE FROM dual
WHERE id IN (
  SELECT accounts.id
  FROM dual
  INNER JOIN accounts
  ON dual.id = accounts.id
  WHERE accounts.name = :name
);
-- #    }
-- #    { addCount
-- #      :name string
-- #      :kill int
-- #      :death int
-- #      :win int
-- #      :lose int
UPDATE dual
SET kill = kill + :kill,
    death = death + :death,
    win = win + :win,
    lose = lose + :lose
WHERE id IN (
  SELECT ffapvp.id
  FROM ffapvp
  INNER JOIN accounts ON (
    accounts.id = ffapvp.id
  )
  WHERE accounts.name = :name
);
-- #    }
-- #    { getranking
-- #      :limit int
SELECT accounts.name, accounts.id, dual.kill
FROM dual
INNER JOIN accounts
ON dual.id = accounts.id
limit :limit
ORDER BY kill DESC;
-- #    }
-- #  }
-- #}
