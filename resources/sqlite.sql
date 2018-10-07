-- #!sqlite
-- #{ userdataprovider
-- #  { accounts
-- #    { init
CREATE TABLE IF NOT EXISTS accounts(
  id   INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT UNIQUE
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
-- #    { get
-- #      :name string
SELECT *
FROM accounts
WHERE name = :name;
-- #    }
-- #  }
-- #  { ffapvp
-- #    { init
CREATE TABLE IF NOT EXISTS ffapvp(
  id    INTEGER NOT NULL,
  kill  INTEGER NOT NULL DEFAULT 0,
  death INTEGER NOT NULL DEFAULT 0,
  exp   INTEGER NOT NULL DEFAULT 0
);
-- #    }
-- #    { register
-- #      :name string
INSERT INTO ffapvp(
  id
)
SELECT id
FROM  accounts
WHERE name = :name;
-- #    }
-- #    { unregister
-- #      :name string
DELETE FROM ffapvp
WHERE id
IN (
  SELECT     accounts.id
  FROM       ffapvp
  INNER JOIN accounts
  ON         ffapvp.id = accounts.id
  WHERE      accounts.name = :name
);
-- #    }
-- #    { get
-- #      :name string
SELECT accounts.id, accounts.name, ffapvp.kill, ffapvp.death, ffapvp.exp
FROM       ffapvp
INNER JOIN accounts
ON         ffapvp.id = accounts.id
WHERE      accounts.name = :name;
-- #    }
-- #    { add
-- #      :name string
-- #      :kill int
-- #      :death int
-- #      :exp int
UPDATE ffapvp
SET kill  = kill + :kill,
    death = death + :death,
    exp   = exp + :exp
WHERE id IN (
  SELECT     ffapvp.id
  FROM       ffapvp
  INNER JOIN accounts
  ON(
    accounts.id = ffapvp.id
  )
  WHERE accounts.name = :name
);
-- #    }
-- #    { getrankingbyExp
-- #      :limit int
SELECT accounts.id, accounts.name, ffapvp.kill, ffapvp.death, ffapvp.exp
FROM       ffapvp
INNER JOIN accounts
ON         ffapvp.id = accounts.id
LIMIT      :limit
ORDER BY exp DESC;
-- #    }
-- #    { getrankingbykill
-- #      :limit int
SELECT accounts.id, accounts.name, ffapvp.kill, ffapvp.death, ffapvp.exp
FROM       ffapvp
INNER JOIN accounts
ON         ffapvp.id = accounts.id
limit      :limit
ORDER BY kill DESC;
-- #    }
-- #  }
-- #  { duel
-- #    { init
CREATE TABLE IF NOT EXISTS duel(
  id    INTEGER NOT NULL,
  kill  INTEGER NOT NULL DEFAULT 0,
  death INTEGER NOT NULL DEFAULT 0,
  win   INTEGER NOT NULL DEFAULT 0,
  lose  INTEGER NOT NULL DEFAULT 0
);
-- #    }
-- #    { register
-- #      :name string
INSERT INTO duel(
  id
)
SELECT id
FROM accounts
WHERE name = :name;
-- #    }
-- #    { unregister
-- #      :name string
DELETE FROM duel
WHERE id IN (
  SELECT     accounts.id
  FROM       duel
  INNER JOIN accounts
  ON         duel.id = accounts.id
  WHERE      accounts.name = :name
);
-- #    }
-- #    { get
SELECT accounts.id, accounts.name, duel.kill, duel.death, duel.win, duel.lose
FROM       duel
INNER JOIN accounts
ON         duel.id = accounts.id
WHERE      accounts.name = :name;
-- #    }
-- #    { add
-- #      :name string
-- #      :kill int
-- #      :death int
-- #      :win int
-- #      :lose int
UPDATE duel
SET kill = kill + :kill,
    death = death + :death,
    win = win + :win,
    lose = lose + :lose
WHERE id IN (
  SELECT     duel.id
  FROM       duel
  INNER JOIN accounts
  ON         accounts.id = duel.id
  WHERE      accounts.name = :name
);
-- #    }
-- #    { getrankingbywin
-- #      :limit int
SELECT accounts.id, accounts.name, duel.kill, duel.death, duel.win, duel.lose
FROM       duel
INNER JOIN accounts
ON         duel.id = accounts.id
limit      :limit
ORDER BY win DESC;
-- #    }
-- #  }
-- #  { corepvp
-- #    { init
CREATE TABLE IF NOT EXISTS corepvp (
  id    INTEGER NOT NULL,
  kill  INTEGER NOT NULL DEFAULT 0,
  death INTEGER NOT NULL DEFAULT 0,
  win   INTEGER NOT NULL DEFAULT 0,
  lose  INTEGER NOT NULL DEFAULT 0,
  exp   INTEGER NOT NULL DEFAULT 0
);
-- #    }
-- #    { register
-- #      :name string
INSERT INTO corepvp(
  id
)
SELECT id
FROM   accounts
WHERE  name = :name;
-- #    }
-- #    { unregister
-- #      :name string
DELETE FROM corepvp
WHERE id IN (
SELECT     accounts.id
FROM       corepvp
INNER JOIN accounts
ON         corepvp.id = accounts.id
WHERE      accounts.name = :name
);
-- #    }
-- #    { get
-- #      :name string
SELECT accounts.id, accounts.name, corepvp.kill, corepvp.death, corepvp.win, corepvp.lose
FROM       corepvp
INNER JOIN accounts
ON         corepvp.id = accounts.id
WHERE      accounts.name = :name;
-- #    }
-- #    { add
-- #      :name string
-- #      :kill int
-- #      :death int
-- #      :win int
-- #      :lose int
-- #      :exp
UPDATE corepvp
SET kill = kill + :kill,
    death = death + :death,
    win = win + :win,
    lose = lose + :lose,
    exp = exp + :exp
WHERE id
IN (
  SELECT corepvp.id FROM corepvp
  INNER JOIN accounts
  ON accounts.id = corepvp.id
  WHERE accounts.name = :name
);
-- #    }
-- #    { getrankingbykill
-- #      :limit int
SELECT accounts.id, accounts.name, corepvp.kill, corepvp.death, corepvp.win, corepvp.lose,corepvp.exp
FROM       corepvp
INNER JOIN accounts
ON         corepvp.id = accounts.id
limit      :limit
ORDER BY kill DESC;
-- #    }
-- #    { getrankingbywin
-- #      :limit int
SELECT accounts.id, accounts.name, corepvp.kill, corepvp.death, corepvp.win, corepvp.lose,corepvp.exp
FROM       corepvp
INNER JOIN accounts
ON         corepvp.id = accounts.id
limit      :limit
ORDER BY win DESC;
-- #    }
-- #    { getrankingbyexp
-- #      :limit int
SELECT accounts.id, accounts.name, corepvp.kill, corepvp.death, corepvp.win, corepvp.lose,corepvp.exp
FROM       corepvp
INNER JOIN accounts
ON         corepvp.id = accounts.id
limit      :limit
ORDER BY exp DESC;
-- #    }
-- #  }
-- #}