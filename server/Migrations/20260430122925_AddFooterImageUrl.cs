using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace ThstiServer.Migrations
{
    /// <inheritdoc />
    public partial class AddFooterImageUrl : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<string>(
                name: "FooterImageUrl",
                table: "GlobalSettings",
                type: "nvarchar(max)",
                nullable: true);
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "FooterImageUrl",
                table: "GlobalSettings");
        }
    }
}
