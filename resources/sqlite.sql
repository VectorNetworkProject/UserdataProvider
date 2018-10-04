-- #{ dataprovider
-- #  { init
-- #    { accounts
CREATE TABLE IF NOT EXISTS accounts(
  id INT PRIMARY KEY AUTOINCREMENT,
  use_name TEXT NOT NULL,
)
-- #    }

-- #    { ffapvp_userdata
CREATE TABLE IF NOT EXISTS ffapvp_usedata