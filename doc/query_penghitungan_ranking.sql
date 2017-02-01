# To refresh your leaderboard, we'll query the ranks for the game into a temporary table, flush old records from scores, then copy
# the new ranked table into your leaderboards table.
# We'll use MySQL's CREATE TABLE...SELECT syntax to select our resultset into it directly upon creation.
create temporary table tmp_leaderboards (rank integer primary key auto_increment, user_ibiza_id integer, points integer)
  select id as user_ibiza_id, points from user_ibizas order by points desc;
  
# Remove old rankings from the overall leaderboards, then copy the results of the temp table into it.
delete from leaderboards;
insert into leaderboards (rank, user_ibiza_id, points)
  select rank, user_ibiza_id, points from tmp_leaderboards;

# And we're done with our temp table
drop table tmp_leaderboards;