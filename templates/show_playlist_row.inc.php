<?php
/* vim:set softtabstop=4 shiftwidth=4 expandtab: */
/**
 *
 * LICENSE: GNU General Public License, version 2 (GPLv2)
 * Copyright 2001 - 2015 Ampache.org
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License v2
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 */
?>
<td class="cel_play">
    <span class="cel_play_content">&nbsp;</span>
    <div class="cel_play_hover">
    <?php if (AmpConfig::get('directplay')) {
    ?>
        <?php echo Ajax::button('?page=stream&action=directplay&object_type=playlist&object_id=' . $libitem->id,'play', T_('Play'),'play_playlist_' . $libitem->id);
    ?>
        <?php if (Stream_Playlist::check_autoplay_append()) {
    ?>
            <?php echo Ajax::button('?page=stream&action=directplay&object_type=playlist&object_id=' . $libitem->id . '&append=true','play_add', T_('Play last'),'addplay_playlist_' . $libitem->id);
    ?>
        <?php 
}
    ?>
        <?php if (Stream_Playlist::check_autoplay_next()) {
    ?>
            <?php echo Ajax::button('?page=stream&action=directplay&object_type=playlist&object_id=' . $libitem->id . '&playnext=true', 'play_next', T_('Play next'), 'nextplay_playlist_' . $libitem->id);
    ?>
        <?php 
}
    ?>
<?php 
} ?>
    </div>
</td>
<td class="cel_playlist"><?php echo $libitem->f_link; ?></td>
<td class="cel_add">
    <span class="cel_item_add">
        <?php echo Ajax::button('?action=basket&type=playlist&id=' . $libitem->id,'add', T_('Add to temporary playlist'),'add_playlist_' . $libitem->id); ?>
        <?php if (Access::check('interface', '25')) {
    ?>
        <?php echo Ajax::button('?action=basket&type=playlist_random&id=' . $libitem->id,'random', T_('Random to temporary playlist'),'random_playlist_' . $libitem->id);
    ?>
            <a id="<?php echo 'add_playlist_'.$libitem->id ?>" onclick="showPlaylistDialog(event, 'playlist', '<?php echo $libitem->id ?>')">
                <?php echo UI::get_icon('playlist_add', T_('Add to existing playlist'));
    ?>
            </a>
        <?php 
} ?>
    </span>
</td>
<td class="cel_type"><?php echo $libitem->f_type; ?></td>
<td class="cel_songs"><?php echo $libitem->get_song_count(); ?></td>
<td class="cel_owner"><?php echo scrub_out($libitem->f_user); ?></td>
<?php if (User::is_registered()) {
    ?>
    <?php if (AmpConfig::get('ratings')) {
    ?>
    <td class="cel_rating" id="rating_<?php echo $libitem->id;
    ?>_playlist"><?php Rating::show($libitem->id, 'playlist');
    ?></td>
    <?php 
}
    ?>
    <?php if (AmpConfig::get('userflags')) {
    ?>
    <td class="cel_userflag" id="userflag_<?php echo $libitem->id;
    ?>_playlist"><?php Userflag::show($libitem->id, 'playlist');
    ?></td>
    <?php 
}
    ?>
<?php 
} ?>
<td class="cel_action">
    <?php if (Access::check_function('batch_download') && check_can_zip('playlist')) {
    ?>
            <a rel="nohtml" href="<?php echo AmpConfig::get('web_path');
    ?>/batch.php?action=playlist&amp;id=<?php echo $libitem->id;
    ?>">
                    <?php echo UI::get_icon('batch_download', T_('Batch Download'));
    ?>
            </a>
    <?php 
} ?>
    <?php if (Access::check('interface', '25')) {
    ?>
        <?php if (AmpConfig::get('share')) {
    ?>
            <?php Share::display_ui('playlist', $libitem->id, false);
    ?>
        <?php 
}
    ?>
    <?php 
} ?>
    <?php if ($libitem->has_access()) {
    ?>
        <a id="<?php echo 'edit_playlist_'.$libitem->id ?>" onclick="showEditDialog('playlist_row', '<?php echo $libitem->id ?>', '<?php echo 'edit_playlist_'.$libitem->id ?>', '<?php echo T_('Playlist edit') ?>', 'playlist_row_')">
            <?php echo UI::get_icon('edit', T_('Edit'));
    ?>
        </a>
        <?php echo Ajax::button('?page=browse&action=delete_object&type=playlist&id='.$libitem->id, 'delete', T_('Delete'), 'delete_playlist_'.$libitem->id, '', '', T_('Do you really want to delete the playlist?'));
    ?>
    <?php 
} ?>
</td>
